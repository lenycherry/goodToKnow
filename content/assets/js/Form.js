class Form {
    constructor() {
        this.loginPseudo = document.getElementById('login_pseudo')
        this.loginMdp = document.getElementById('login_mdp')
        this.pseudo = document.getElementById('pseudo')
        this.mail = document.getElementById('mail')
        this.mdp = document.getElementById('mdp')
        this.confirmMdp = document.getElementById('confirm_mdp')
        this.loginBtn = document.querySelector('.login_btn')
        this.registerBtn = document.querySelector('.register_btn')
        this.pseudoErrorMessage = document.getElementById('pseudo_error_message')
        this.mailErrorMessage = document.getElementById('mail_error_message')
        this.mdpErrorMessage = document.getElementById('mdp_error_message')
        this.confirmMdpErrorMessage = document.getElementById('confirm_mdp_error_message')
        this.loginPseudoErrorMessage = document.getElementById('login_pseudo_error_message')
        this.loginMdpErrorMessage = document.getElementById('login_mdp_error_message')
        this.errorMessage = document.getElementById('error_message')
        //regex pour les champs à compléter
        this.pseudoValid = /^[a-zA-Z0-9*(é|è|à|ù)]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9*(é|è|à|ù)]*)*$/
        this.mailValid = /^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i
        this.mdpValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/
        //validation du formulaire d'inscription selon critères
        this.registerBtn.addEventListener("click", e => {
            this.formValidation()
        })
         //validation du formulaire de connexion selon critères
        this.loginBtn.addEventListener("click", e => {
            this.loginFormValidation()
        })
    }
    formValidation() {
        //nettoyage des précédents messages d'erreurs
        this.errorMessage.textContent = ""
        this.pseudoErrorMessage.textContent = ""
        this.mailErrorMessage.textContent = ""
        this.mdpErrorMessage.textContent = ""
        this.confirmMdpErrorMessage.textContent = ""
        //Revue des conditions d'erreurs et affichage des messages correspondants
        if (this.pseudo.value == "") {
            event.preventDefault()
            this.pseudoErrorMessage.textContent = "Pseudo vide."
            this.pseudoErrorMessage.style.color = 'red'
        } else if (this.pseudoValid.test(this.pseudo.value) == false) {
            event.preventDefault()
            this.pseudoErrorMessage.textContent = "Saisie de pseudo incorrecte."
            this.pseudoErrorMessage.style.color = 'red'
        }
        if (this.mail.value == "") {
            event.preventDefault()
            this.mailErrorMessage.textContent = "Mail vide."
            this.mailErrorMessage.style.color = 'red'
        } else if (this.mailValid.test(this.mail.value) == false) {
            event.preventDefault()
            this.mailErrorMessage.textContent = "Saisie de mail incorrecte."
            this.mailErrorMessage.style.color = 'red'
        }
        if (this.mdp.value == "") {
            event.preventDefault()
            this.mdpErrorMessage.textContent = "Mot de passe vide."
            this.mdpErrorMessage.style.color = 'red'
        } else if (this.mdpValid.test(this.mdp.value) == false) {
            event.preventDefault()
            this.mdpErrorMessage.textContent = "Veuillez entrer un mot de passe valide. 8 caractères minimum, au moins une lettre, au moins un chiffre."
            this.mdpErrorMessage.style.color = 'red'
        }
        if (this.confirmMdp.value == "") {
            event.preventDefault()
            this.confirmMdpErrorMessage.textContent = "Confirmation de mot de passe vide."
            this.confirmMdpErrorMessage.style.color = 'red'
        }
        else if (this.mdp.value != this.confirmMdp.value) {
            event.preventDefault()
            this.confirmMdpErrorMessage.textContent = "Les Mots de passes ne correspondent pas."
            this.confirmMdpErrorMessage.style.color = 'red'
        }

    }
    loginFormValidation() {
        //nettoyage des précédents messages d'erreurs
        this.loginPseudoErrorMessage.textContent = ""
        this.loginMdpErrorMessage.textContent = ""
        this.errorMessage.textContent = ""
        let isMail = 0
        //Détermine si l'identifiant est un mail ou un Pseudo
        for(let i = 0; i < this.loginPseudo.value.length; i++){
            if (this.loginPseudo.value[i] == "@"){
                isMail =1
            }
        }
        //vérification des champs vides et non-conforme REGEX
        if (this.loginPseudo.value == "") {
            event.preventDefault()
            this.loginPseudoErrorMessage.textContent = "Identifiant vide."
            this.loginPseudoErrorMessage.style.color = 'red'
        } else if (isMail == 1) {
            if (this.mailValid.test(this.loginPseudo.value) == false) {
                event.preventDefault()
                this.errorMessage.textContent = "Identifiant ou mot de passe incorrecte."
                this.errorMessage.style.color = 'red'
            }
        } else if (isMail == 0) {
            if (this.pseudoValid.test(this.loginPseudo.value) == false) {
                event.preventDefault()
                this.errorMessage.textContent = "Identifiant ou mot de passe incorrecte."
                this.errorMessage.style.color = 'red'
            }
        }
        if (this.loginMdp.value == "") {
            event.preventDefault()
            this.loginMdpErrorMessage.textContent = "Mot de passe vide."
            this.loginMdpErrorMessage.style.color = 'red'
        }
    }
}

let registerForm = new Form()

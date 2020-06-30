class Alert {
    constructor() {
        let alert = document.querySelectorAll('.jf_alert')
        alert.forEach(e => {e.addEventListener('click', this.jf_alert)
        })
    }
    jf_alert() {
        let stop = window.confirm('Voulez-vous effectuer cette action ?')
        if (stop == false) {
            event.preventDefault()
        }
    }
}
let alertErase = new Alert()
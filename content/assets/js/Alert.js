class Alert {
    constructor() {
        let alert = document.querySelectorAll('.GTK_alert')
        alert.forEach(e => {e.addEventListener('click', this.GTK_alert)
        })
    }
    GTK_alert() {
        let stop = window.confirm('Voulez-vous effectuer cette action ?')
        if (stop == false) {
            event.preventDefault()
        }
    }
}

let alertAction = new Alert()
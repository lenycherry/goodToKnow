class MyObserver {

    constructor() {
        this.ratio = .1
        this.options = {
            root: null,
            rootMargin: "0px",
            threshold: this.ratio
        }
        document.documentElement.classList.add('reveal-loaded')
        window.addEventListener('DOMContentLoaded', e => {
            this.observer = new IntersectionObserver(this.handleIntersect, this.options)
            this.targets = document.querySelectorAll(".reveal")
            this.targets.forEach((target) => {
                this.observer.observe(target)
            })
        })
    }
    handleIntersect = function (entries, observer) {
        entries.forEach((entry) => {
            if (entry.intersectionRatio > myObserver.ratio) {
                entry.target.classList.remove('reveal')
                entry.target.classList.add('reveal-loaded')
                observer.unobserve(entry.target)
            }
        })
    }
}

let myObserver = new MyObserver()
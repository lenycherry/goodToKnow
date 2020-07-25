class LetterWrapper {
    constructor() {
      // Wrap every letter in a span
      this.textWrapper = document.querySelector('.ml9 .letters');
      this.textWrapper.innerHTML = this.textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

      anime.timeline({ loop: false })
        .add({
          targets: '.ml9 .letter',
          scale: [0, 1],
          duration: 1500,
          elasticity: 600,
          delay: (el, i) => 45 * (i + 1)
        })
    }
}

let homeTitleAnimation = new LetterWrapper()

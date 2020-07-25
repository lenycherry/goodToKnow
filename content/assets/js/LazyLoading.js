class LazyLoading {
  constructor() {

    this.lazyloadImages = document.querySelectorAll("img.lazy");
    this.lazyloadThrottleTimeout;

    document.addEventListener("scroll", e => { this.lazyload() });
    window.addEventListener("resize", e => { this.lazyload() });
    window.addEventListener("orientationChange", e => { this.lazyload() });
  }
  lazyload() {
    if (this.lazyloadThrottleTimeout) {
      clearTimeout(this.lazyloadThrottleTimeout);
    }
    this.lazyloadThrottleTimeout = setTimeout(e=>{
      var scrollTop = window.pageYOffset;
      this.lazyloadImages.forEach(function (img) {
        if (img.offsetTop < (window.innerHeight + scrollTop)) {
          if(img.classList.contains('lazy')){
          img.src = img.dataset.src;
          img.classList.remove('lazy');
          }
        }
      });
      if (this.lazyloadImages.length == 0) {
        document.removeEventListener("scroll", this.lazyload);
        window.removeEventListener("resize", this.lazyload);
        window.removeEventListener("orientationChange", this.lazyload);
      }
    }, 20);
  }
}
let LazyLoadingImg = new LazyLoading()

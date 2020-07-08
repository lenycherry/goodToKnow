class Pagination {
    constructor() {
        this.firstPageBtn = document.querySelector('.first_page_btn')
        this.previousPageBtn = document.querySelector('.previous_page_btn')
        this.nextPageBtn = document.querySelector('.next_page_btn')
        this.lastPageBtn = document.querySelector('.last_page_btn')
        this.articles = document.getElementsByClassName('article_content_container')
        this.numberOfItems = 4;
        this.first = 0;
        this.actualPage = 1;
        this.maxPages = Math.ceil(this.articles.length / this.numberOfItems);

        this.showList();
        this.firstPageBtn.addEventListener('click',e=>{
            this.firstPage()
        })
        this.previousPageBtn.addEventListener('click',e=>{
            this.previousPage()
        })
        this.nextPageBtn.addEventListener('click',e=>{
            this.nextPage()
        })
        this.lastPageBtn.addEventListener('click',e=>{
            this.lastPage()
        })
    }

    firstPage() {
        this.first = 0;
        this.actualPage = 1;
        this.showList();
    }

    nextPage() {
        if (this.first + this.numberOfItems <= this.articles.length) {
            this.first += this.numberOfItems;
            this.actualPage++;
            this.showList();
        }
    }
    previousPage() {
        if (this.first - this.numberOfItems >= 0) {
            this.first -= this.numberOfItems;
            this.actualPage--;
            this.showList();
        }
    }
    lastPage() {
        this.first = (this.maxPages * this.numberOfItems) - this.numberOfItems;
        this.actualPage = this.maxPages;
        this.showList();
    }
    showList() {
        for(let i = 0; i< this.articles.length;i++){
            this.articles[i].classList.replace('visible','invisible')
        }
        for (let i = this.first; i < this.first + this.numberOfItems; i++) {

            if (i < this.articles.length) {
                this.articles[i].classList.replace('invisible','visible')
            }
        }

        this.showPageInfo();
    }
    showPageInfo() {
        document.getElementById('pageInfo').innerHTML = `
          Page ${this.actualPage} / ${this.maxPages}
        `
    }
}

let articlePagination = new Pagination()
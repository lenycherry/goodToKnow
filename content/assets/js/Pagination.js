class Pagination {
    constructor() {
        this.commentList = ['test1', 'test2', 'test3', 'test4', 'test5', 'test6', 'test7']//document.getElementsByClassName('comment_list');
        this.numberOfItems = 5;
        this.first = 0;
        this.actualPage = 1;
        this.maxPages = Math.ceil(this.commentList.length / this.numberOfItems);

        showList();
    }

     firstPage() {
        this.first = 0;
        this.actualPage = 1;
        showList();
    }

    nextPage() {
        if (this.first + numberOfItems <= this.commentList.length) {
            this.first += numberOfItems;
            this.actualPage++;
            showList();
        }
    }
    previous() {
        if (this.first - numberOfItems >= 0) {
            this.first -= numberOfItems;
            this.actualPage--;
            showList();
        }
    }
    lastPage() {
        this.first = (this.maxPages * numberOfItems) - numberOfItems;
        this.actualPage = this.maxPages;
        showList();
    }
    showList() {
        let tableList = "";
        for (let i = this.first; i < this.first + numberOfItems; i++) {
            console.log(i);
            if (i < this.commentList.length) {
                tableList += `
        <tr>
          <td>${this.commentList[i]}</td>
        </tr>
      `
            }
        }
        document.getElementById('articles_home_container').innerHTML = tableList;
        showPageInfo();
    }
    showPageInfo() {
        document.getElementById('pageInfo').innerHTML = `
          Page ${this.actualPage} / ${this.maxPages}
        `
    }
}

let commentPagination = new Pagination()
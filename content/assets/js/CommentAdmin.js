class CommentAdmin {
    constructor(title_article_comment) {
        this.titleArticleComment = document.querySelectorAll(title_article_comment)
        this.commentContainer = document.querySelectorAll('.admin_comments_content')

        for (let i = 0; i < this.titleArticleComment.length; i++) {
            this.titleArticleComment[i].addEventListener("click", e => {
                let container = this.commentContainer[i]
                this.toggleContainer(container)
            })
        }
    }
    toggleContainer(container) {
        if (container.classList.contains('com_invisible')) {
            container.classList.replace('com_invisible', 'com_visible')
        } else if (container.classList.contains('com_visible')) {
            container.classList.replace('com_visible', 'com_invisible')
        }
    }
}
let commentAdmin = new CommentAdmin('.title_article_comment')
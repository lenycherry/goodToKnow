class CommentDisplay {
    constructor() {
        this.containerJson = document.getElementById('comments_container_json')
        this.jsonUrl = document.getElementById('json_url').innerText
        this.reportUrl = document.getElementById('url_host').innerText + "reportComment/id/"
        this.editUrl = document.getElementById('url_host').innerText + "editComment/id/"
        this.deleteUrl = document.getElementById('url_host').innerText + "deleteComment/id/"
        this.pseudo = document.getElementById('json_pseudo').innerText
        this.findJson()
    }
    // requête ajax pour afficher les commentaires dynamiquement dans le Html.
    findJson = async function () {
        let response = await fetch(this.jsonUrl)
        let comments = await response.json()
        comments.forEach(comment => {
            let commentContainer = document.createElement("div")
            commentContainer.classList.add("article_comment_container")

            let pseudoComment = document.createElement("h3")
            pseudoComment.innerText = comment.pseudo
            commentContainer.appendChild(pseudoComment)

            let contentComment = document.createElement("p")
            contentComment.innerText = comment.content
            commentContainer.appendChild(contentComment)

            let createDateComment = document.createElement("p")
            createDateComment.classList.add("date_comment")
            createDateComment.innerText = comment.create_date
            commentContainer.appendChild(createDateComment)

            if (comment.edit_date != null) {
                let editDateComment = document.createElement("p")
                editDateComment.classList.add("date_comment")
                editDateComment.innerText = comment.edit_date
                commentContainer.appendChild(editDateComment)
            }
            console.log(this.pseudo, comment.pseudo)
            if(this.pseudo != "" && this.pseudo != comment.pseudo){
            let reportBtn = document.createElement("a")
            reportBtn.classList.add('GTK_alert', 'report_com_btn', 'btn')
            reportBtn.innerText = "Signaler"
            reportBtn.href = this.reportUrl + comment.id
            commentContainer.appendChild(reportBtn)
            }
            if (this.pseudo == comment.pseudo) {
                let editBtn = document.createElement("a")
                editBtn.classList.add('edit_com_btn', 'btn')
                editBtn.innerText = "Editer"
                editBtn.href = this.editUrl + comment.id
                commentContainer.appendChild(editBtn)

                let deleteBtn = document.createElement("a")
                deleteBtn.classList.add('GTK_alert', 'delete_com_btn', 'btn')
                deleteBtn.innerText = "Effacer"
                deleteBtn.href = this.deleteUrl + comment.id
                commentContainer.appendChild(deleteBtn)
            }

            this.containerJson.appendChild(commentContainer)
        });
        //initialise un nouvel objet alert à la fin de la requête ajax afin que le message d'alerte fonctionne correctement
        let alertAjax = new Alert()

    }
}

let commentArticleDisplay = new CommentDisplay()
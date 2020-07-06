class CommentDisplay {
    constructor() {
        this.containerJson = document.getElementById('comments_container_json')
        this.jsonUrl = document.getElementById('json_url').innerText
        this.reportUrl = document.getElementById('report_url').innerText
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
            pseudoComment.innerHTML = comment.pseudo
            commentContainer.appendChild(pseudoComment)

            let contentComment = document.createElement("p")
            contentComment.innerHTML = comment.content
            commentContainer.appendChild(contentComment)

            let createDateComment = document.createElement("p")
            createDateComment.classList.add("date_comment")
            createDateComment.innerHTML = comment.create_date
            commentContainer.appendChild(createDateComment)

            if (comment.edit_date != null) {
                let editDateComment = document.createElement("p")
                editDateComment.classList.add("date_comment")
                editDateComment.innerHTML = comment.edit_date
                commentContainer.appendChild(editDateComment)
            }
            let reportBtn = document.createElement("a")
            reportBtn.classList.add('GTK_alert', 'report_com_btn', 'btn')
            reportBtn.innerText = "Signaler"
            reportBtn.href = this.reportUrl + comment.id 
            commentContainer.appendChild(reportBtn)

            this.containerJson.appendChild(commentContainer)
        });
        //initialise un nouvel objet alert à la fin de la requête ajax afin que le message d'alerte fonctionne correctement
        let alertAjax = new Alert()

    }
}

let commentArticleDisplay = new CommentDisplay()
class MenuAdmin {
    constructor(home_admin_title, admin_articles_btn, admin_comments_btn, admin_reported_btn) {
        this.homeAdminTitle = document.getElementById(home_admin_title)
        this.adminArticleBtn = document.getElementById(admin_articles_btn)
        this.adminCommentBtn = document.getElementById(admin_comments_btn)
        this.adminReportedBtn = document.getElementById(admin_reported_btn)

        this.initAdminPanel()
        this.homeAdminTitle.addEventListener("click", e => {
            this.closeAll()
        })
        this.adminArticleBtn.addEventListener("click", e => {
            this.closeAll()
            let container = document.getElementById('admin_article')
            this.openContainer(container)
        })
        this.adminCommentBtn.addEventListener("click", e => {
            this.closeAll()
            let container = document.getElementById('admin_comment')
            this.openContainer(container)
        })
        this.adminReportedBtn.addEventListener("click", e => {
            this.closeAll()
            let container = document.getElementById('admin_comment_reported')
            this.openContainer(container)
        })
    }
    initAdminPanel() {
        let container = document.getElementById('admin_article')
        this.openContainer(container)
    }
    openContainer(container) {
        if (container.classList.contains('menu_invisible')) {
            container.classList.replace('menu_invisible', 'menu_visible')
        }
    }
    closeAll() {
        let containers = document.getElementsByClassName('menu_visible')
        for (let i = 0; i < containers.length; i++) {
            containers[i].classList.replace('menu_visible', 'menu_invisible')
        }
    }
}
let menuAdmin = new MenuAdmin('home_admin_title', 'admin_articles_btn', 'admin_comments_btn', 'admin_reported_btn')
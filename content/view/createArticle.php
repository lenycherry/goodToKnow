<?php $title = 'GTK - Créer un article' ?>
<?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1)) : ?>
    <div id="create_article_page_container">
        <form action=" <?php echo HOST; ?>addArticle" method="POST" enctype="multipart/form-data">
            <label for='title'>Titre</label>
            <input id="title" type="text" placeholder="Insérer votre titre" name="values[title]" />
            <label for='image'>Image</label>
            <p class='form_p'>5Mo max. Fichier au format .jpg, .jpeg, .png, .gif.</p>
            <input id="image" type="file" name="uploaded_file" />
            <label for="textArea">Nouvel article</label>
            <textarea id='textArea' name='values[content]' placeholder="Rédigez votre article"></textarea>
            <button class="btn" type="submit" value="Valider" name="submit">Valider</button>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea#textArea',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            importcss_append: true,
            height: 100,
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 100,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>
<?php else : ?>
    <?php $location = HOST; ?>
    <?php header("Location: $location"); ?>
<?php endif; ?>
import banner from "@/admin/js/components/Tinymce/banner";
import uniqueButton from "@/admin/js/components/Tinymce/button";
const tinySettings = {
    height: 600,
    plugins: 'lists link image table code help wordcount template',
    toolbar: 'undo redo | image link | formatselect | fontsizeselect | fontselect | lineheight | styles | bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table forecolor backcolor  template',
    fontsize_formats: '8px 10px 12px 14px 16px 18px 24px 36px 48px',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    },
    language: 'ru',
    content_css:'/assets/admin/css/tinymce.css',
    font_formats:
        "Georgia=georgia, sans-serif;  Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; " +
        "Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; " +
        "Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier;" +
        "Helvetica=helvetica; Impact=impact,chicago; " +
        "Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; " +
        "Terminal=terminal,monaco; Times New Roman=times new roman,times; " +
        "Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; " +
        "Wingdings=wingdings,zapf dingbats",
    templates: [
        {
            title: 'Блок баннер',
            description: '',
            content: banner,
        },
        {
            title: 'Кнопка проверить уникальность',
            description: '',
            content: uniqueButton,
        },
    ],
    table_background_color_map: [
        { title: 'Gray', value: 'F0F1F6' },
        { title: 'Orange', value: 'FF9902' },
        { title: 'Blue', value: '366AF3' },
    ],
    color_map: [
        'F0F1F6', 'Gray',
        'FF9902', 'Orange',
        '366AF3', 'Blue'
    ]
}
export default tinySettings;

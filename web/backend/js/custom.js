(function ($) {
    doConfirm = function (message,doAction) {
        swal({
            title:message,
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "取消",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true
                },
                confirm: {
                    text: "确定",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                doAction();
            }
        });
    };
    toastSuccess = function (message){
        $.toast({
            heading: '成功提示',
            text: message,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-center'
        })
    };
    toastError = function (message){
        $.toast({
            heading: '错误提示',
            text: message,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f2a654',
            position: 'top-center'
        })
    };
    initTinyMce = function (id){
        tinymce.init({
            selector: '#'+id,
            height: 500,
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            content_css: [],
            language:'zh_CN'
        });
    }
})(jQuery);
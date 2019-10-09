
var AjaxLoad = {

    initialize: function(){
        this.initializeEvents();
        this.paginations = [];
    },
    getFormElem: function(clickedElem){
        var formElem =  clickedElem.closest('form');

        if (formElem.length == 0){
             formElem =  clickedElem.closest('.modal').find('form');
        }

        return formElem;
    },
    getContainerElem: function (clickedElem){
        var containerElem = $(clickedElem.closest('form').attr('js-container'));

        if (containerElem.length == 0){
             containerElem =  clickedElem.closest('.modal').find('.js-modal-container');
        }

        return containerElem;
    },
    initializePagination(formElem){
        var self = this;
        if (typeof self.paginations[formElem.attr('js-container')] == "undefined"){
            self.paginations[formElem.attr('js-container')] = new Pagination();
        }
    },
    initializeEvents: function(){
        var self = this;
        $(document).on('click', '.js-submit', function(e) {
           e.preventDefault();

           var formElem = self.getFormElem($(this));
           var containerElem = self.getContainerElem($(this));
           self.initializePagination(formElem);
           self.paginations[formElem.attr('js-container')].page = 1;

           var additional_data = self.paginations[formElem.attr('js-container')].getData();
           if ($(this).closest('.modal').length){
               additional_data["is_modal"] = true;
           }

           self.submit(containerElem, formElem, formElem.attr('action'),
               "POST",additional_data);

        });

        /**
         * Initialization of modal, for now is used: data-modalid, data-url, data-modaltitle, data-savetext, data-maxwidth
         * But any kind of data can be passed through DOM
         *
         */
        $(document).on('click', '.js-modal', function(e) {
            e.preventDefault();

            var modalId = $(this).attr('data-modalid');
            var modalElem = $('#'+$(this).attr('data-modalid'));
            var url = $(this).attr('data-url');
            var title = $(this).attr('data-modaltitle');
            var savetext = $(this).attr('data-savetext');
            var maxwidth = $(this).attr('data-maxwidth') ? $(this).attr('data-maxwidth') : 1500;

            // if there is no modal create it and append to body
            if (modalElem.length == 0){
                var modal = $('<div id="'+modalId+'"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
                                '<div class="modal-dialog" style="max-width:' + maxwidth + 'px">' +
                                  '<div class="modal-content">' +
                                    '<div class="modal-header">' +
                                      '<h5 class="modal-title mt-0 js-modal-title">Modal title</h5>' +
                                      '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                                    '</div>' +
                                    '<div class="modal-body js-modal-container">' +
                                      '<p>Modal body text goes here.</p>' +
                                    '</div>' +
                                    '<div class="modal-footer">' +
                                      '<button js-container=".js-modal-container" type="button" class="btn btn-default js-submit">Save changes</button>' +
                                      '<button type="button" class="btn btn-secondary js-modal-cancel" data-dismiss="modal">Zatvori</button>' +
                                    '</div>' +
                                  '</div>' +
                                '</div>' +
                              '</div>');

                $('body').append(modal);
                modalElem = $('#'+$(this).attr('data-modalid'));

                if (!savetext){
                    modalElem.find('.js-submit').remove();
                }
            }


            // then load url in that modal and display it
            $.ajax(url).done(function(response){

                if (typeof response.message != "undefined" && response.message.length) {
                    toastr[response.message[0]](response.message[1]);
                }
                else{
                    modalElem.find('.js-modal-container').html(response.html);

                    if (typeof title !== "undefined"){
                        modalElem.find('.js-modal-title').html(title);
                    }

                    if (typeof savetext !== "undefined"){
                        modalElem.find('.js-submit').html(savetext);
                    }

                    modalElem.modal('show');
                }
            });
        });

        /**
         * Pagination click is submitting the form which wrapps the table
         * and additionally sending pagination data (page,orderBy,direction...)
         */
        $(document).on('click', 'form .pagination .page-link', function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            var loc = new URL(href);
            var page = loc.search.substring(loc.search.indexOf("page=") + 5);

            var formElem = self.getFormElem($(this));
            var containerElem = self.getContainerElem($(this));

            self.initializePagination(formElem);

            self.paginations[formElem.attr('js-container')].page = page;

            self.submit(containerElem, formElem, loc.origin + loc.pathname,
                "POST", self.paginations[formElem.attr('js-container')].getData());
        });

        /**
         * Table header order click is submitting the form which wrapps the table
         * and additionally sending pagination / order data (page,orderBy,direction...)
         */
        $(document).on('click',  'form [js-order-by]', function(e){
            e.preventDefault();
            var orderBy = $(this).attr('js-order-by');

            var direction = 'ASC';
            if ( $(this).attr('js-direction') && $(this).attr('js-direction') == 'ASC' ){
                direction = 'DESC' ;
            }

            var formElem = self.getFormElem($(this));
            var containerElem = self.getContainerElem($(this));

            self.initializePagination(formElem);

            self.paginations[formElem.attr('js-container')].table_id = $(this).closest('table').attr('id');
            self.paginations[formElem.attr('js-container')].orderBy = orderBy;
            self.paginations[formElem.attr('js-container')].direction = direction;

            self.submit(containerElem, formElem, formElem.attr('action'),
            "POST",self.paginations[formElem.attr('js-container')].getData());
        });

        /**
         * Exporting table data
         */
        $(document).on('click', 'form .js-exportall', function(e){
            e.preventDefault();
            var formElem = self.getFormElem($(this));
            location.href = formElem.attr('action') + '?'
                    + formElem.serialize() + '&export_filename=' + $(this).attr('filename');
        });

        /**
         *  Dom element click collects ajax submit data and sends to backend
         *  Intended for atomic actions something like enable/disable, change status etc..
         *  There is no form so data is sent from dom elem as additional data
         */
        $(document).on('click', '.js-elem-submit', function(e){
            e.preventDefault();

            var Data = $(this).data();
            var containerElem = $($(this).attr('js-container'));
            var url = $(this).attr('js-url');

            self.submit(containerElem, $(this), url,"POST", Data);
        });

    },

    /*
     * Wrap form elems with js-showhide-form-container if you dont want to send them
     */
    submit: function(containerElem, formElem, url, type, additional_data){
        var self = this;

        var is_modal = typeof additional_data != "undefined" && typeof additional_data["is_modal"] != "undefined";
        var Data = new FormData();

        $.each($('input[type="file"]'), function(i, file_elem) {
            if ($(file_elem).closest('.js-showhide-form-container').length ==0 ||
                    $(file_elem).is(':visible')){
                // If  we are in part of form (.js-showhide-form-container) which can be show/hide-ed
                Data.append($(file_elem).attr('name'), file_elem.files[0]);
            }
        });

        $.each(formElem.serializeArray(), function(i, elem) {
            if ($('[name="'+elem.name+'"]').closest('.js-showhide-form-container').length ==0 ||
                    $('[name="'+elem.name+'"]').is(':visible')){
                Data.append(elem.name, elem.value);
            }
        });

        if (additional_data){
            $.each(additional_data , function(key, val) {
                if (val){
                    Data.append(key, val);
                }
            });
        }

        if (type == 'GET'){
            var queryString = new URLSearchParams(Data).toString();
            url += '?' + queryString;
        }

        $.ajax({
            type: (typeof type != "undefined") ? type : 'POST',
            url: url,
            data: Data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function () {
                containerElem.block();
            },
            success: function (response) {
                if (response.html) {
                    containerElem.html(response.html);
                }

                // special case for model to close
                if (response.success) {
                   containerElem.closest('.modal').modal('hide');
                    // if (response.reload) {
                    //     location.reload();
                    // }
                }

                if (typeof response.message != "undefined" && response.message.length) {
                    toastr[response.message[0]](response.message[1]);
                }

                //if there is pagination set sorting icon
                if (typeof self.paginations[formElem.attr('js-container')] !== "undefined"){
                    self.paginations[formElem.attr('js-container')].setSortingIcon();
                }

                /**
                 * Run callbacks if we are not in modal,
                 * or if we are in modal run them if modal finished action succesfully
                 */
                if (!is_modal || (typeof response.success != "undefined" && response.success)){
                    var callbacks = formElem.attr('js-callbacks');
                    var callbackMethod = null;
                    if (callbacks){
                        callbacks = callbacks.split(',');
                        for(var i=0; i < callbacks.length; i++) {
                            callbackMethod = eval(callbacks[i]);
                            callbackMethod(response,additional_data);
                        }
                    }
                }

            },
            complete: function (data){
                containerElem.unblock();
            }

        });
    }
}



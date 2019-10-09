function Pagination() {
    this.table_id = null;
    this.page = null;
    this.orderBy = null;
    this.direction = null;
    // changing Sorting Arrow icon
    this.setSortingIcon = function(){
        if (this.orderBy){
            var elem = $('#' + this.table_id).find('[js-order-by=' + this.orderBy+ ']');
            elem.attr('js-direction', this.direction);
            if (this.direction == "ASC"){
                elem.append('<i class="fa fa-arrow-up"></i>');
            }
            else{
                elem.append('<i class="fa fa-arrow-down"></i>');
            }
        }
    };

    this.getData = function(){
        return {
            page:this.page,
            orderBy:this.orderBy,
            direction:this.direction
        }
    };

}

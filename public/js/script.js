$(document).ready(function(){

    $('#category').on('change',function(){
        var category = $(this).val();
        var _token = $('input[name=_token]').val();
        $.ajax({
            url: '/library',
            type:"GET",
            data:{
                category: category,
                _token: _token
            },
            success:function(data){
                var books = data.books;
                var html='';
                if(books.length > 0){
                    for(let i=0; i<books.length; i++){
                        html += "<tr>\
                                <td>"+books[i]['title']+"</td>\
                                <td>"+books[i]['author']+"</td>\
                                <td>"+books[i]['pag']+"</td>\
                                <td>\
                                <button type='button' class='btn btn-warning btn-sm text-right' onclick='reserve("+books[i]['id']+")'>\
                                Reservar\
                                </button>\
                                </td>\
                                </tr>";
                    }
                }
                else{
                    html += '<tr>\
                            <td>No Books</td>\
                            </tr>';
                }

                $('#books_tbody').html(html);
            }

        });
    });

});
function reserve(id) {
    $.get('librarys/'+id, function(book){
        $('#title').text(book.title);
        $('#author').text(book.author);
        $('#description').text(book.description);
        $('#page').text('Page: '+book.pag);
        $("#imgBook").attr("src",book.urlimage);
        $('#id').val(book.id);
        console.log(book);

        $('#reserveModal').modal('toggle');
    })
  };

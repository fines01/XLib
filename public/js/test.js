
(function($){
 $(document).ready(function(){
  
  const bigTitleImg= $('big-title-img');
  const IsbnSearchURL = 'https://www.googleapis.com/books/v1/volumes?q=isbn:';

  //event-listener: input isbn
  $('#isbn-search').click(function(event){ // oder keyup()
   event.preventDefault();

  if($('#isbn13').val().length !== 0 ){
  //validate
  console.log('isbn13 ok')
    var isbn = $('#isbn13').val();
  }
  else if($('#isbn10').val() !== 0){
    //validate
    console.log('isbn10 ok');
    var isbn = $('#isbn10').val()
  }
   
   //console.log( isbn ); //check
   
   if (isbn13 != ''){
    //check validity
    const isbn = isbn13;
   }else if(isbn10 != ''){
    //check validity
    const isbn= isbn10;
   }
   else{
    alert('please enter a valid ISBN.')
   }
   //check validity, if ok:
   //var isbn = $('.isbn').val();

   $.ajax({
    url: IsbnSearchURL + isbn,
    dataType: "json",
    //type: 'POST';
    success: function(response) {
     console.log(response)
     if(response.totalItem === 0){
      console.log("no results, sorry...");
     }
     else{
      alert('OK');
      //displayResult(response);
      const book=response.items[0].volumeInfo;
      const title= book.title;
      const subtitle = book.subtitle;
      const author1= book.authors[0].split(" ");
      const publisher= book.publisher;
      const pubDate = book.publishedDate;
      if(book.imageLinks){
       const bookImgSm= book.imageLinks.smallThumbnail;
       const bookImg= book.imageLinks.thumbnail;
       $('title-img').attr("src",bookImg);
       $('title-img-sm').attr("src",bookImgSm);

       // // das Autor Problem:
       // var n = author1.length;
       // for (i=0; i<n-2; i++){
       //  var fnames += author1[i];
       // }
       // var lname=author1[n-1];

       // fill in form:
       $('#title').val(title);
       $('#subtitle').val(subtitle);
       $('#publisher').val(publisher);
       $('#year').val(pubDate);
       $('#lname').val(author1[author1.length -1]);
       $('#fname').val(author1.pop());
      $('#title-img').val(bookImg);
      }

      console.log(title, subtitle, author1, publisher); //check
     }
    },
    error: function() {
     console.log('Oops, sorry. Something went wrong...');
    }

   })
  });

 });
})(jQuery);

// google API base URL:
// https://www.googleapis.com/books/v1/volumes
// isbn search:
// {{ $baseURL }}?q=isbn:{{ $isbn }}

// item->volumeInfo->imageLinks->smallThumbnail |thumbnail
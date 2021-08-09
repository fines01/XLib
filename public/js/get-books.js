
(function($){
 $(document).ready(function(){
  
  const bigTitleImg= $('big-title-img');
  const IsbnSearchURL = 'https://www.googleapis.com/books/v1/volumes?q=isbn:';

  //event-listener: input isbn
  $('#isbn-search').click(function(event){ // oder keyup()
   event.preventDefault();

  if($('#isbn13').val().length !== 0 ){
    //remove - and validate
    console.log('isbn13 ok')
    var isbn = $('#isbn13').val();
  }
  else if($('#isbn10').val() !== 0){
    //validate
    console.log('isbn10 ok');
    var isbn = $('#isbn10').val()
  }
   
   //console.log( isbn ); //check
   //or:
   
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
     if(response.totalItems === 0){
      console.log("No results, sorry...");
     }
     else{
      console.log('Book found!');
      //displayResult(response);
      const book=response.items[0].volumeInfo;
      const title= book.title;
      const subtitle = book.subtitle;
      const author1= book.authors[0];
      //const author1= book.authors[0].split(" ");
      const publisher= book.publisher;
      const pubDate = book.publishedDate; // ACHTUNG ev DATE statt nur YEAR !!
      
      if(book.imageLinks){
        const bookImgSm= book.imageLinks.smallThumbnail;
        const bookImg= book.imageLinks.thumbnail;
        $('#title-img').val(bookImg);

        console.log(bookImg);
      } else {
        console.log("no images found");
      }

       // fill in form:
       if (title) {$('#title').val(title);}
       if (subtitle) {$('#subtitle').val(subtitle);}
       if (publisher){ $('#publisher').val(publisher);}

        // !!! pubDate in year-->
      if(pubDate.length > 4 ){ 
        const year= pubDate.slice(0,4); 
        if (year) {$('#year').val(year); console.log('year: ', year);}
      }
      else if (pubDate){ $('#year').val(pubDate); }
        //$('#lname').val(author1[author1.length -1]);
        //$('#fname').val(author1.pop());
        console.log(title, subtitle, author1, publisher, pubDate);
    }
     },
    error: function() {
     console.log('Oops, sorry. Something went wrong...');
    }

   })
  });

 });
})(jQuery);
 let form = document.querySelector("#form");
 let result = document.querySelector("#result");
 form.addEventListener('submit', function(event) {

     let minPrice = this.querySelector("[name='min-price']").value;
     let maxPrice = this.querySelector("[name='max-price']").value;
     let quantity = this.querySelector("[name='quantity']").value;
     let promise = fetch('/table.php/', {
         method: 'POST',
         body: new FormData(this),
     });

     promise.then(
         response => {
             return response.text();
         }
     ).then(
         text => {
             result.innerHTML = text;
         }
     );
     event.preventDefault();
 });
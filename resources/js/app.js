//
$("#addAnewTask").click(function (e) {
    e.preventDefault();
    

       $.ajax({
        url: '/here',
        type: 'POST',
        success: function(response) {
            console.log('הנתונים התקבלו בהצלחה:', response);
            $('#resultContainer').text(response.message);
        },
        error: function(xhr, status, error) {
            console.error('שגיאה בבקשה:', error);
        }
})

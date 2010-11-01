
//---------------------------------------------------------------------------
/*
    this function is used to open a page with an id field as a POST argument.
*/
function OpenPageWithId(page, id) 
{
    
    var form = document.createElement("form");  // create a new form
    form.setAttribute("method", "post");
    form.setAttribute("action", page);

    var hiddenField = document.createElement("input");  // create a field for the id
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "id");
    hiddenField.setAttribute("value", id);

    form.appendChild(hiddenField);  // append field
    document.body.appendChild(form); // append form
    form.submit();      // submit
}

/*-------------------------------------------------------------------------*/
function DeleteRecord(page, id, name) 
{
    var message = "האם אתה בטוח שברצונך למחוק את " + name + " לאחר המחיקה לא יהיה ניתן לשחזר את המידע";
    agree = confirm( message );
    if (agree) 
    {
        OpenPageWithId(page, id);
    }
}

/*-------------------------------------------------------------------------*/
function ResetPassword() 
{
    var message = " ?האם אתה בטוח שברצונך לאפס את ססמת החשבון שלך  לחיצה על אישור תגרום לשליחת ססמא חדשה אל תיבת הדואר שלך " ;
    agree = confirm( message );
    if (agree) 
    {
    	location.replace('sendpassword.php'); 
    }
}





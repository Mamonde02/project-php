

// Show toast if message exists
window.onload = function () {
    var toastEl = document.getElementById("loginToast");
    if (toastEl && toastEl.querySelector('.toast-body').textContent.trim() !== "") {
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
};


// Cat Facts
const catFactButton = document.getElementById("catFactButton");
catFactButton.addEventListener('click', async () => {
    try {
        const response = await fetch("https://catfact.ninja/fact");
        const data = await response.json();
        console.log(data);

        const catFact = data.fact;
        const catFactElement = document.getElementById("catFact");

        // Generate Display and Render the Jokes 
        catFactElement.innerHTML = `Cat Fact: ${catFact}`;

    } catch (error) {
        console.error(error);
    }
});


// Open Update Form
function openUpdateForm(noteId, title, notetype, comment) {
    document.getElementById("noteId").value = noteId;
    document.getElementById("title").value = title;
    document.getElementById("notetype").value = notetype;
    document.getElementById("comment").value = comment;
    document.getElementById("updateForm").style.display = "block";
}

edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element) => {
    element.addEventListener('click', (e) => {
        $button = e.target.parentNode.parentNode;
        $title = $button.getElementsByTagName('h5')[0].innerText;
        $desc = $button.getElementsByTagName('p')[1].innerText;
        $author = $button.getElementsByTagName('p')[2].innerText;
        eTitle.value = $title;
        eDesc.value = $desc;
        eAuthor.value = $author;
        update.value = e.target.id;
        // console.log(update);


    })
})

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener('click', (e) => {
        id = e.target.id.substring(1);
        console.log(id);
        window.location = `index.php?delete=${id}`;
        // console.log(update);


    })
})
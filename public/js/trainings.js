const inviteButtons = document.querySelectorAll('.invite-button');

function invite() {
    const inviteButton = this;
    const invitedUserId = inviteButton.previousSibling.previousSibling.value;
    const trainingDate = inviteButton.previousSibling.previousSibling.previousElementSibling.value;
    
    const tmpDate = new Date(trainingDate);
    const now = new Date();

    if (tmpDate < now || trainingDate == '') {
        alert("Choose correct date!");
        return;
    }

    const data = {userId: invitedUserId, date: trainingDate};

    fetch("/arrangeTraining", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
}

inviteButtons.forEach(button => button.addEventListener("click",  invite));
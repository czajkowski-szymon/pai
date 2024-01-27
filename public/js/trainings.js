const trainingsContainer = document.querySelector(".trainings");
const invitationsContainer = document.querySelector(".invitations");

const acceptButton = document.querySelector('button');
const trainingId = acceptButton.getAttribute('training-id');

acceptButton.addEventListener('click', function(event) {
    const data = {id: trainingId};
    console.log('halo');    
    
    fetch("/acceptInvite", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function () {
        location.reload();
    });
});
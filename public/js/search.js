const search = document.querySelector('input[placeholder="City"]');
const profileContainer = document.querySelector(".profiles");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {city: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (profiles) {
            profileContainer.innerHTML = "";
            loadProfiles(profiles)
        });
    }
});

function loadProfiles(profiles) {
    profiles.forEach(profile => {
        createProfile(profile);
    });
}

function createProfile(profile) {
    const template = document.querySelector("#profile-template");

    const clone = template.content.cloneNode(true);
        
    const image = clone.querySelector("img");
    image.src = `../public/uploads/${profile.photo_url}`;
    
    const name = clone.querySelector(".name");
    name.innerHTML = profile.first_name;

    const city = clone.querySelector("#city");
    city.innerHTML = profile.city_name;

    const bio = clone.querySelector("#bio");
    bio.innerHTML = profile.bio;

    const likes = clone.querySelector("#likes");
    likes.innerHTML = " " + profile.likes;

    const dislikes = clone.querySelector("#dislikes");
    dislikes.innerHTML = " " + profile.dislikes;

    const sportList = clone.querySelector("ul");
    const sportNames = profile.sport_names.replace(/\s/g, '').split(',');

    sportNames.forEach(sportName => {
        const newListItem = document.createElement("li");
        newListItem.innerHTML = sportName;
        sportList.appendChild(newListItem)
    })

    const buttonInput = clone.querySelector('input[name="user-id"]');
    buttonInput.value = profile.user_id;

    profileContainer.appendChild(clone);
}
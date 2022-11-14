btnVote = document.querySelectorAll('.vote');

btnVote.forEach( (element) => {
    element.addEventListener('click' , (e) => {
        console.log(e.target.dataset.vote)
        action = e.target.dataset.vote;
        envoieVote(action);

    })
})

function envoieVote(action) {
    fetch('/article/vote/' + action).then(function(response) {
        if(response.ok) {
            /// console.log(response.json());
            response.json().then(function (response) {
                nbVotes = response.vote;
                console.log(nbVotes);
                document.getElementById('nbVotes').innerText = nbVotes;
            });


        } else {
            console.log('Mauvaise réponse du réseau');
        }
    })
        .catch(function(error) {
            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        });


}





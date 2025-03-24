setInterval(() => {
    fetch('../pages/get_data.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector(".card.blue p").innerText = data.temperature + " °C";
            document.querySelector(".card.green p").innerText = data.humidity + " %";
            document.querySelector(".card.red p").innerText = data.distance + " cm";
        });
}, 5000);

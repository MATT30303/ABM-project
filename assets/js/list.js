document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("fetchButton").addEventListener("click", function () {
    const name = document.getElementById("nameInput").value;

    fetch("./assets/php/list.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name: name }),
    })
      .then((response) => response.json())
      .then((data) => {
        let output = "<ul>";
        data.forEach((item) => {
          output += `<li>Name: ${item.name}, Email: ${item.email}</li>`;
        });
        output += "</ul>";
        document.getElementById("data").innerHTML = output;
      })
      .catch((error) => console.error("Error fetching data:", error));
  });
});

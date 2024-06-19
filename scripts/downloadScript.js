// downloadScript.js

document.addEventListener('DOMContentLoaded', function() {
    const appsInstallerLink = document.getElementById('appsInstallerLink');

    appsInstallerLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default download behavior

        fetch(this.href)
            .then(response => response.text())
            .then(data => {
                const blob = new Blob([data], { type: 'application/octet-stream' });
                const url = URL.createObjectURL(blob);

                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = 'AppsInstaller.bat'; // Specify the desired file name

                document.body.appendChild(a);
                a.click();

                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error fetching file:', error);
                // Handle error if needed
            });
    });
});

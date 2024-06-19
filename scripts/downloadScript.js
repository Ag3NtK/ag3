// downloadScript.js

function downloadFile(url, filename) {
    // Create a temporary link element
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;

    // Append the link to the body
    document.body.appendChild(link);

    // Programmatically click the link to trigger the download
    link.click();

    // Remove the link from the document
    document.body.removeChild(link);
}

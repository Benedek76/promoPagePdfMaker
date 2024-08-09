<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to PDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #editor-container, #editor-container2, #editor-container3, #editor-container4 {
            height: 150px;
            width: 100%;
        }
        #preview, #preview2, #preview3, #preview4 {
            display: none;
            width: 1100px;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
            box-sizing: border-box;
            border: 1px solid lightgray;
            white-space: pre-wrap; /* Maintain whitespace formatting */
        }
        #editor-container2, #editor-container3, #editor-container4 {
            height: 50px;
        }
        #generate{
            width: 100%;
            padding: 20px;
            font-size: 20px;
            background-color: #d200ec;
            color: black;
            cursor: progress;
            border-width: 4px;
            font-family: sans-serif!important;
        }
        button {
            background-color: black;
            padding: 10px;   
            color: #d200ec; 
            cursor: pointer;
        }
        a { 
            float: right;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="information">
        <a href="./logout.php" class="information__button">
        <button style="font-size:24px; font-family: arial">Logout <i class="fa fa-sign-out"></i></button></a>
            <h1 class="information__title" style="font-family: arial">You are logged in as <span style="color: #8CEC00"><?= $_SESSION['name']; ?></span></h1>
            
            <!-- Static image 1 -->
            <img id="image1" src="./images/page_1.png" alt="Energy drinks collection" style="width: 100%;">

            <div id="formContainer">
                <form id="myForm">
                    <h3 id="price-title">1. PRICE</h3>
                    <textarea id="name1" name="price1" style="display:none;">
                        The pricing structure for our services is designed to be both competitive and transparent. All prices listed are subject to the terms 
                        outlined in the agreement. Discounts may be applicable based on the volume of services purchased or long-term commitments. 
                        For customized solutions, a detailed quote will be provided upon request. All prices are exclusive of applicable taxes and duties. 
                        Payment terms will be outlined in the invoice and must be adhered to as per the agreed schedule. Please note that prices are subject 
                        to change without prior notice. Special promotions and offers may also be available periodically. For further information, 
                        please contact our sales department.
                    </textarea>
                    <div id="editor-container"></div>
                    <div id="preview"></div>  

                    <!-- New sections with default text -->
                    <br>
                    <br>
                    <h3 id="minimum-order-title">2. MINIMUM ORDER</h3>
                    <textarea id="name2" name="order2" style="display:none;">
                        Minimum order quantity is: *TO BE COMPLETED*
                    </textarea>
                    <div id="editor-container2"></div>
                    <div id="preview2"></div>  

                    <h3>3. PAYMENT METHODS</h3>
                    <textarea id="name3" name="payment3" style="display:none;">
                        Payment conditions: *TO BE COMPLETED*
                    </textarea>
                    <div id="editor-container3"></div>
                    <div id="preview3"></div>  

                    <h3>4. MARKET</h3>
                    <textarea id="name4" name="market4" style="display:none;">
                        The product is available exclusively for sale within the designated country.
                        Please be aware that these terms remain effective for a period of one month from the date this document was issued (as indicated above).
                        If any adjustments to these conditions are necessary, they must be agreed upon in writing before the expiration date.
                    </textarea>                    
                    <div id="editor-container4"></div>
                    <div id="preview4"></div>                      
                </form>
            </div>
            <p></p>

            <!-- Static image 2 -->
            <img id="image4" src="./images/page_4.png" alt="Example Image 4" style="width: 100%;">
            <img id="image5" src="./images/page_5.png" alt="Example Image 5" style="width: 100%;">
            <img id="image6" src="./images/page_6.png" alt="Example Image 6" style="width: 100%;">

            <button id="generate" type="button" onclick="generatePDF()">Generate PDF</button>
        </div>
    </div>

    <script type="text/javascript">
        // Initialize Quill editors
        var quill = new Quill('#editor-container', { theme: 'snow' });
        var quill2 = new Quill('#editor-container2', { theme: 'snow' });
        var quill3 = new Quill('#editor-container3', { theme: 'snow' });
        var quill4 = new Quill('#editor-container4', { theme: 'snow' });

        // Set initial content from textarea
        function setInitialContent(quill, textareaId) {
            var textarea = document.getElementById(textareaId).value;
            var formattedText = textarea.replace(/\n/g, '<br>');
            quill.clipboard.dangerouslyPasteHTML(formattedText);
        }

        setInitialContent(quill, 'name1');
        setInitialContent(quill2, 'name2');
        setInitialContent(quill3, 'name3');
        setInitialContent(quill4, 'name4');

        async function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape', unit: 'pt' });

            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();

            // Function to add images to the PDF
            async function addImageToPDF(imgId) {
                const img = document.getElementById(imgId);
                const imgData = await getImageData(img);
                const imgHeight = pageHeight;
                const imgWidth = imgHeight * img.naturalWidth / img.naturalHeight;
                const imgX = (pageWidth - imgWidth) / 2;
                doc.addImage(imgData, "JPEG", imgX, 0, imgWidth, imgHeight);
            }

            // Add image 1
            await addImageToPDF("image1");

            // Add new page for the form content
            doc.addPage();

            // Get the content of the Quill editor
            const editorContent = quill.root.innerHTML;
            const previewDiv = document.getElementById("preview");

            // Add the title and content to the preview div
            previewDiv.innerHTML = `<h3>1. PRICE</h3>${editorContent}`;
            previewDiv.style.display = "block";

            // Convert preview div to canvas and add to PDF
            const formCanvas = await html2canvas(previewDiv);
            const formImgData = formCanvas.toDataURL("image/png");
            doc.addImage(formImgData, 'PNG', 10, 10);

            // Hide the preview div
            previewDiv.style.display = "none";

            // Add new page for the combined new sections
            doc.addPage();

            const sections = [
                { editor: quill2, title: '2. MINIMUM ORDER', preview: 'preview2' },
                { editor: quill3, title: '3. PAYMENT METHODS', preview: 'preview3' },
                { editor: quill4, title: '4. MARKET', preview: 'preview4' }
            ];

            let combinedContent = '';
            for (const section of sections) {
                const content = section.editor.root.innerHTML;
                combinedContent += `<div style="padding-top: 20px;"><h3>${section.title}</h3><div>${content}</div></div>`;
            }

            const combinedPreviewDiv = document.createElement("div");
            combinedPreviewDiv.innerHTML = combinedContent;
            document.body.appendChild(combinedPreviewDiv);
            const combinedCanvas = await html2canvas(combinedPreviewDiv);
            const combinedImgData = combinedCanvas.toDataURL("image/png");
            doc.addImage(combinedImgData, 'PNG', 10, 10);
            document.body.removeChild(combinedPreviewDiv);

            // Add new page for each remaining image
            const images = ["image4", "image5", "image6"];
            for (let i = 0; i < images.length; i++) {
                doc.addPage();
                await addImageToPDF(images[i]);
            }

            // Save PDF
            doc.save("form_data.pdf");
        }

        function getImageData(img) {
            return new Promise(resolve => {
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");
                canvas.width = img.naturalWidth;
                canvas.height = img.naturalHeight;
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                resolve(canvas.toDataURL("image/jpeg"));
            });
        }
    </script>
</body>
</html>
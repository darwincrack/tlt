   url_base = $("#url_base").val();
 
Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );




function preview_snapshot() {
            // freeze camera so user can preview pic
            Webcam.freeze();
            
            // swap button sets
            document.getElementById('pre_take_buttons').style.display = 'none';
            document.getElementById('post_take_buttons').style.display = '';
        }
        
        function cancel_preview() {
            // cancel preview freeze and return to live camera feed
            Webcam.unfreeze();
            
            // swap buttons back
            document.getElementById('pre_take_buttons').style.display = '';
            document.getElementById('post_take_buttons').style.display = 'none';
        }
        
        function save_photo() {
            // actually snap photo (from preview freeze) and display it
            Webcam.snap( function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/><p>Foto Actual</p>';
                // swap buttons back
                document.getElementById('pre_take_buttons').style.display = '';
                document.getElementById('post_take_buttons').style.display = 'none';

                    var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
 
                    document.getElementById('namafoto').value = raw_image_data;


            } );
        }
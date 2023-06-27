$(document).ready(function(){
                
                $('#sel_user').change(function(){
                    var username = $(this).val();
                    $.ajax({
                        url:baseURL+'index.php/user/userDetails',
                        method: 'post',
                        data: {username: username},
                        dataType: 'json',
                        success: function(response){
                            var len = response.length;

                            if(len > 0){
                                // Read values
                                var uname = response[0].username;
                                var name = response[0].name;
                                var email = response[0].email;
                                
                                $('#suname').text(uname);
                                $('#sname').text(name);
                                $('#semail').text(email);
                               
                            }else{
                                $('#suname').text('');
                                $('#sname').text('');
                                $('#semail').text('');
                            }
                           
                        }
                    });
                });
            });
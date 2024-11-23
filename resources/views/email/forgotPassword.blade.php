<body style="background-color:grey">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
           width="550" bgcolor="white" style="border:1px solid rgb(104, 103, 103);box-shadow: 2px 2px 2px 2px #888888;">
        <tbody>
            <tr>
                <td align="center">
                    <table align="center" border="0" cellpadding="0"
                           cellspacing="0" class="col-550" width="550">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #44D62C;
                                           height: 50px;">
 
                                    <a href="#" style="text-decoration: none;">
                                        <p style="color:white;
                                                  font-weight:bold;font-size:20px">
                                            AgileSole
                                        </p>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr style="height: 300px;">
                <td align="center" style="border: none;
                           border-bottom: 2px solid #4cb96b; 
                           padding-right: 20px;padding-left:20px">
 
                    <p style="font-weight: bolder;font-size: 42px;
                              letter-spacing: 0.025em;
                              color:black;">
                              Hello User!
                             <span style="font-size: 24px !important;color:black;">{{$email}}</span><br />   
                              Forget Password Email                      
                          </p>
                </td>
            </tr>
 
            <tr style="display: inline-block;">
                <td style="height: 150px;
                           padding: 20px;
                           border: none; 
                           border-bottom: 2px solid #361B0E;
                           background-color: white;">
                   
                    <h2 style="text-align: left;
                               align-items: center;">
                      You can reset password from bellow link:
                   </h2>
                  
                   <a class="font-size:18px;" href="{{ route('reset.password.get', $token) }}">Reset Password</a> 
                </td>
            </tr>
            <tr style="border: none; 
            background-color: #44D62C; 
            height: 40px; 
            color:white; 
            padding-bottom: 20px; 
            text-align: center;">
                
<td height="40px" align="center">
    <p style="color:white; 
    line-height: 1.5em;">
    AgileSole
    </p>
  <p style="color:white; 
    line-height: 1.5em;">
Contact : +92306-9158103   
</p>  
</td>
</tr>
<tr>
<td style="font-family:'Open Sans', Arial, sans-serif;
           font-size:11px; line-height:18px; 
           color:#999999; padding:7px;" 
    valign="top"
    align="center">
                  © 2024 AgileSole. All Rights Reserved.<br>               
            </td>
              </tr>
            </tbody></table></td>
        </tr>
    
        </tbody>
    </table>
</body>
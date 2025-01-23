<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width" />
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<title>Submission Stage Changed Email</title>
    	<style type="text/css">
    		body {
		        background-color: #f6f6f6;
		        font-family: sans-serif;
		        -webkit-font-smoothing: antialiased;
		        font-size: 14px;
		        line-height: 1.4;
		        margin: 0;
		        padding: 0; 
		        -ms-text-size-adjust: 100%;
		        -webkit-text-size-adjust: 100%; 
		    }
		    .container {
		        display: block;
		        Margin: 0 auto !important;
		        /* makes it centered */
		        max-width: 580px;
		        padding: 10px;
		        width: 580px; 
		    }
		    .content {
		        box-sizing: border-box;
		        display: block;
		        Margin: 0 auto;
		        max-width: 580px;
		        padding: 10px; 
		    }
		    table {
		        border-collapse: separate;
		        mso-table-lspace: 0pt;
		        mso-table-rspace: 0pt;
		        width: 100%; 
		    }
		    table td {
		        font-family: sans-serif;
		        font-size: 14px;
		        vertical-align: top; 
		    }
		    .body {
		        background-color: #f6f6f6;
		        width: 100%; 
		    }
		    .main {
		        background: #fff;
		        border-radius: 3px;
		        width: 100%; 
		        padding: 22px;
		    }
		    .btn {
		        box-sizing: border-box;
		        width: 100%; 
		    }
	        .btn > tbody > tr > td {
	          padding-bottom: 15px; 
	      	}
	        .btn table {
	          width: auto; 
	      	}
	        .btn table td {
	          background-color: #ffffff;
	          border-radius: 5px;
	          text-align: center; 
	      	}
	        .btn a {
	          background-color: #ffffff;
	          border: solid 1px #3498db;
	          border-radius: 5px;
	          box-sizing: border-box;
	          color: #3498db;
	          cursor: pointer;
	          display: inline-block;
	          font-size: 14px;
	          font-weight: bold;
	          margin: 0;
	          padding: 12px 25px;
	          text-decoration: none;
	          text-transform: capitalize; 
	      	}
		    .btn-primary table td {
		        background-color: #3498db; 
		    }
		    .btn-primary a {
		        background-color: #3498db;
		        border-color: #3498db;
		        color: #ffffff; 
		    }
	      	h1,
		    h2,
		    h3,
		    h4,
		    h5 {
		        color: #000000;
		        font-family: sans-serif;
		        font-weight: 400;
		        line-height: 1.4;
		        margin: 0;
		        margin-bottom: 30px; 
		    }
		    h1 {
		        font-size: 35px;		        
		    }
		    h5 {
		        font-size: 18px;
		    }
		    p {
		        font-family: sans-serif;
		        font-size: 14px;
		        font-weight: normal;
		        margin: 0;
		        margin-bottom: 15px; 
		    }
    	</style>
    </head>
    <body>
    	<table border="0" cellpadding="0" cellspacing="0" class="body">
	      	<tr>
		        <td>&nbsp;</td>
		        <td class="container">
		          <div class="content">
			    		<!-- START MAIN CONTENT AREA -->
			            <table class="main">
			              	<tr>
				                <td class="wrapper">
				                  	<table border="0" cellpadding="0" cellspacing="0">				                  		
					                    <tr>
					                      	<td>
					                      		<h2>Hello {{ config('constant.submission_receiver_name') }},</h2>
						                        <h5>There is an evaluation process waiting - kindly log into ICES to review and process submissions on this stage.
						                        <p></p>
						                        <p>--</p>
						                        Thank you.
						                    	</h5>						                        
					                      	</td>
					                    </tr>
				                  	</table>
				                </td>
			              	</tr>

			            <!-- END MAIN CONTENT AREA -->
			            </table>
			        </div>
			    </td>
			</tr>
		</table>
        
    </body>
</html>
<!-- 
	01001110 01100101 00100000 01101101 01110101 01110100 01101100 01110101 00100000 01010100 11000011 10111100 01110010 01101011 00100111 11000011 10111100 01101101 00100000 01100100 01101001 01111001 01100101 01101110 01100101 00100001 

	https://github.com/ugurkilci/depremtek
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DepremTek - Deprem Teknolojileri Geliştir</title>
        <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
        <meta name="description" content="DepremTek, çözülmesi gereken deprem sorunlarının paylaşıldığı websitedir."/>
        <link rel="canonical" href="https://depremtek.com" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="DepremTek - Deprem Teknolojileri Geliştir" />
        <meta property="og:description" content="DepremTek, çözülmesi gereken deprem sorunlarının paylaşıldığı websitedir." />
        <meta property="og:url" content="https://depremtek.com" />
        <meta property="og:site_name" content="DepremTek - Deprem Teknolojileri Geliştir" />
        <meta property="og:image" content="" />
        <meta property="og:image:secure_url" content="" />
        <meta property="og:image:width" content="1600" />
        <meta property="og:image:height" content="900" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:description" content="DepremTek, çözülmesi gereken deprem sorunlarının paylaşıldığı websitedir." />
        <meta name="twitter:title" content="DepremTek - Deprem Teknolojileri Geliştir" />
        <meta name="twitter:site" content="@notionplusdev" />
        <meta name="twitter:image" content="" />
        <meta name="twitter:creator" content="@ugur2nd" />
        <meta name="MobileOptimized" content="510">
        <meta name="HandheldFriendly" content="true"/> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="shortcut icon" type="image/ico" href="https://depremtek.vercel.app/img/ico.ico"/>
        <link rel="stylesheet" href="css/style.css?cache=<?=time()?>">
    </head>
    <body>

      <div class="container mt-3 mb-3">
        <div class="row">
          <div class="col-lg-6 col-6">
            <a href="index.html" title="DepremTek"><img src="img/depremtek.svg" width="150px" alt="DepremTek"></a>
          </div>

		  <div class="col-lg-6 col-6 text-end mt-2">
            <a href="https://forms.gle/4fYaw5jtsjF2Jqfm8" target="_blank" rel="noopener noreferrer" class="menu" title="Sorun Var!">Sorun Var!</a>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                DepremTek, çözülmesi gereken deprem sorunlarının paylaşıldığı websitedir.<br>
				Bu sorunları çözebilecek teknolojiler üretin!
            </div>
        </div>
      </div>

      <div class="container mt-5">
        <div class="row">

        	<?php

				// https://airtable.com/shrR8VRcmIFsZkLh4

				$airtableApiKey = "keyn45rJwFqfyHxNZ";
				$airtableTableName = "appaHxjYwFIVeA1gO";
				
				$curl = curl_init();

				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api.airtable.com/v0/'.$airtableTableName.'/icerikler?api_key='.$airtableApiKey.'&sort%5B0%5D%5Bfield%5D=tarih&sort%5B0%5D%5Bdirection%5D=asc',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Bearer df837b993d9eb9248fc2348384d5466ac03824e3b9bae566b4b09aea080eb4d7',
					'Cookie: brw=brw0tGtjIHemFZJ80; AWSALB=jMtD4kh9rsFYpkPPhihc+lxMkbYURIxEcO9MGQ8O5/zjomkrr2obm+K1XA8otfI4f9PmD2l8kkcLspMCXwcEGPAS2fCDvmM9CUYdnsUYE9fWttLcoglmX1ZPyDI+; AWSALBCORS=jMtD4kh9rsFYpkPPhihc+lxMkbYURIxEcO9MGQ8O5/zjomkrr2obm+K1XA8otfI4f9PmD2l8kkcLspMCXwcEGPAS2fCDvmM9CUYdnsUYE9fWttLcoglmX1ZPyDI+'
				),
				));

				$response = curl_exec($curl);
				$response = json_decode( $response, true );
				curl_close($curl);
				
				$posts = array();
				foreach ($response["records"] as $row) {
					$kategori 	= $row["fields"]["kategori"];
					$baslik 	= $row["fields"]["baslik"];
					$aciklama 	= $row["fields"]["aciklama"];
					$tarih 		= $row["fields"]["tarih"];
					$link 		= $row["fields"]["link"];
					$row 		= $row["fields"]["row"];

					if (!isset($posts[$kategori])) {
						$posts[$kategori] = array();
					}

					$posts[$kategori][] = array(
						"baslik" 	=> $baslik,
						"aciklama"	=> $aciklama,
						"tarih" 	=> $tarih,
						"row" 		=> $row,
						"link" 		=> $link
					);
				}

				foreach ($posts as $kategori => $postlar) {
					echo '<div class="col-lg-12 mb-5">
						<h1 class="h5 mb-3"><strong>'.$kategori.'</strong></h1>';
						
						foreach ($postlar as $post) {
							echo '<button data-bs-toggle="modal" data-bs-target="#baslik'.$post["row"].'" class="menu menu-margin">'.$post["baslik"].'</button>
							
							<!-- '.$post["baslik"].' Modal -->
							<div class="modal text-black" id="baslik'.$post["row"].'">
								<div class="modal-dialog">
									<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">'.$post["baslik"].'</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">';

										if(empty($post["aciklama"])){
											echo '<a href="https://forms.gle/s1mVBy5Nk9Xo14uy6" target="_blank" rel="noopener noreferrer" class="menu w-100 d-block text-center" title="Sorun Var!">Sorunu Çözdük! (Yan sekmede aç)</a>';
										}else{
											echo $post["aciklama"].'<br><br>';
											echo '<a href="https://forms.gle/s1mVBy5Nk9Xo14uy6" target="_blank" rel="noopener noreferrer" class="menu w-100 d-block text-center" title="Sorun Var!">Sorunu Çözdük! (Yan sekmede aç)</a>';
										}

										// if($post["kategori"] == "Çözülen Sorunlar"){
										// 	echo '<a href="'.$post["link"].'" target="_blank" rel="noopener noreferrer" class="menu w-100 d-block text-center" title="Sorun Var!">Siteyi Görüntüle</a>';
										// }else{
										// 	echo '<a href="https://forms.gle/s1mVBy5Nk9Xo14uy6" target="_blank" rel="noopener noreferrer" class="menu w-100 d-block text-center" title="Sorun Var!">Sorunu Çözdük! (Yan sekmede aç)</a>';
										// }

										echo '
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
									</div>

									</div>
								</div>
							</div>';
						}
					echo '</div>';
				}

			?>
        </div>
      </div>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ericadventures
 */

?>
<footer>
    <div class="bg-zinc-700 py-10 xl:px-0 px-3">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <div>
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/logo-ericadventures.png" alt="logo" class="w-64">
                    
                </div>
                <div>
                    <span class="block uppercase text-sm font-extrabold text-white mb-2">Eric Adventures</span>
                    <ul>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Info of the Company</a></li>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Programs</a></li>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Services</a></li>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Terms and Conditions</a></li>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Links</a></li>
                        <li class="border-b pb-1 border-b-gray-500 mb-1"><a href="#" class="text-sm text-gray-300 hover:underline">Contact Us</a></li>

                    </ul>
                </div>
                <div>
                    <span class="block uppercase text-sm font-extrabold text-white mb-4">Contact</span>
                     <div class="flex flex-col gap-4">
                        <span class="text-sm text-gray-300"> <i class="fas fa-map-marker-alt"></i> Urb. Santa María A-1-6 San Sebastian Cusco - Peru</span>
                        <span class="text-sm text-gray-300"> <i class="fas fa-mobile-alt"></i> Phone: (+51) 958 346 292 Office</span>
                        <span class="text-sm text-gray-300"> <i class="fab fa-whatsapp"></i> Whatsapp: (+51) 958 346 292 </span>
                        <span class="text-sm text-gray-300"> <i class="far fa-envelope"></i> eric@ericadventures.com </span>
                        
                     </div>
                </div>
                <div>
                     <span class="block uppercase text-sm font-extrabold text-white mb-2">Emergency Phones</span>

                     <span class="text-sm text-gray-300 block mb-3"> <i class="fab fa-whatsapp"></i> Whatsapp: (+51) 958 346 292 </span>

                     <span class="block uppercase text-sm font-extrabold text-white mb-2">Follow Us</span>
                     <div class="flex gap-5">
                            <i class="fab text-white text-xl fa-facebook-f"></i>
                            <i class="fab text-white text-xl fa-twitter"></i>
                            <i class="fab text-white text-xl fa-tiktok"></i>
                            <i class="fas text-white text-xl fa-blog"></i>
                            <i class="fab text-white text-xl  fa-instagram"></i>

                     </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-zinc-800 text-center">
        <small class="text-white">© Copyright Eric Adventures - Cusco, Peru <?=date('Y') ?> </small>
    </div>
</footer>

<?php 
$tour_url = get_permalink();  // Recupera la URL de la página actual
	
if(ICL_LANGUAGE_CODE == 'en'){
    $message = "Hello, I would like more information about ";
    $whatsapp_link = "https://api.whatsapp.com/send/?phone=51958346292&text=" . urlencode($message . $tour_url);
} 
if(ICL_LANGUAGE_CODE == 'es'){
    $message = "Hola, quisiera más información sobre ";
    $whatsapp_link = "https://api.whatsapp.com/send/?phone=51958346292&text=" . urlencode($message . $tour_url);
} 
if(ICL_LANGUAGE_CODE == 'pt-br'){
    $message = "Olá, gostaria de mais informações sobre ";
    $whatsapp_link = "https://api.whatsapp.com/send/?phone=51958346292&text=" . urlencode($message . $tour_url);
} 
if(ICL_LANGUAGE_CODE == 'fr'){
    $message = "Bonjour, je voudrais plus d'informations sur ";
    $whatsapp_link = "https://api.whatsapp.com/send/?phone=51958346292&text=" . urlencode($message . $tour_url);
} 
if(ICL_LANGUAGE_CODE == 'it'){
    $message = "Ciao, vorrei maggiori informazioni su ";
    $whatsapp_link = "https://api.whatsapp.com/send/?phone=51958346292&text=" . urlencode($message . $tour_url);
}
?>

<div class="fixed bottom-0 right-0 z-40 py-6 px-7 mb-0 sm:mb-0 sm:inline-flex">
<a href="<?=$whatsapp_link?>" target="_blank">
<span class="flex relative h-10 w-10">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
</span>
</a>
</div>

<div class="fixed bottom-0 right-0 z-40 py-5 px-4 mb-0 sm:mb-0 sm:inline-flex">
<a href="<?=$whatsapp_link?>" target="_blank">
<img src="<?php echo esc_url(get_template_directory_uri()) ?>/img/whatsapp-icon.png" alt="" class="w-16">
</a>
</div>


<?php wp_footer(); ?>

</body>
</html>

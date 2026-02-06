// Google Maps initialization
let mapInstance = null;
let mapInitialized = false;

function openMapModal() {
    const modal = document.getElementById("mapModal");
    if (!modal) return;
    
    modal.style.display = "flex";
    modal.classList.remove("hidden");
    modal.classList.add("show");
    document.body.style.overflow = "hidden";
    
    // Esperar a que el modal sea visible antes de inicializar el mapa
    setTimeout(() => {
        if (!mapInitialized) {
            initMap(document.querySelector(".acf-map"));
            mapInitialized = true;
        } else if (mapInstance) {
            // Re-centrar el mapa si ya existe
            google.maps.event.trigger(mapInstance, "resize");
        }
    }, 300);
}

function closeMapModal(event) {
    if (!event || event.target.id === "mapModal" || event.currentTarget.tagName === "BUTTON") {
        const modal = document.getElementById("mapModal");
        if (!modal) return;
        
        modal.style.display = "none";
        modal.classList.add("hidden");
        modal.classList.remove("flex", "show");
        document.body.style.overflow = "auto";
    }
}

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeMapModal();
    }
});

function initMap(mapElement) {
    if (!mapElement) {
        console.error("No se encontró el elemento del mapa");
        return;
    }
    
    const marker = mapElement.querySelector(".marker");
    if (!marker) {
        console.error("No se encontró el marcador");
        return;
    }
    
    const lat = parseFloat(marker.dataset.lat);
    const lng = parseFloat(marker.dataset.lng);
    const zoom = parseInt(mapElement.dataset.zoom) || 16;
    
    if (isNaN(lat) || isNaN(lng)) {
        console.error("Coordenadas inválidas");
        return;
    }
    
    mapInstance = new google.maps.Map(mapElement, {
        center: { lat: lat, lng: lng },
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    const markerObj = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: mapInstance,
        animation: google.maps.Animation.DROP
    });
    
    const infowindow = new google.maps.InfoWindow({
        content: marker.innerHTML
    });
    
    markerObj.addListener("click", function() {
        infowindow.open(mapInstance, markerObj);
    });
    
    console.log("Mapa inicializado correctamente");
}

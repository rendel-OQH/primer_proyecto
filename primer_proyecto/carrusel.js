document.addEventListener("DOMContentLoaded", function() {
    let images = ["con1.jpg", "con2.jpg", "con3.jpg", "pos1.jpg", "con5.jpg", "con6.jpg", "con7.jpg", "con8.jpg"];
    let captions = [
        "Enchiladas con aguja norteña \n 3 enchiladas con queso y crema \n 1 pieza de aguja norteña\nchile toreado con tocino y queso\n nopal sadao y frijoles fritos",
        "Tostadas de aguacate \n pan integral tostado \n aguacate+pierna \n huevo estrellado \n papatinas y salsa catsup",
        "Chilaquiles divorciados \n tortilla dorada \n mitad salsa chipotle/mitat salsa verde\nqueso crema\npollo y tocino\naguacate,cilantro y cebolla",
        "Ensalada de fresa y uva \nlechuga china, fresa,uvas\n nuez+almendras+arandanos\npollo a la plancha\n+aderezo de fresa",
        "Enchiladas de adobo + aguala norteña \n 4 enchiladas de adobo frita aguja norteña\nqueso,crema.cebolla cambray,cilantro,frijoles fritos",
        "Chilaquiles \nA eleccion: salsa verde o roja\ntortilla dorara\nqueso cotija,crema\nfilete de pollo\n a eleccio: huevo estrellado o huevo duro ",
        "Burritos \nfajitas de pollo,Arroz,frijol negro\nqueso oaxaca, aderezo de chipotle y \n crema\n guarnicion de pico de gallo\n guarnicion de lechuga con jitomate queso y pepino",
        "Enchiladas \n 4 enchiladas de salsa roja o verde a eleccio\n pechuga,crema,queso,lechuga y frijoles"
    ];
    let currentIndex = 0;
    const carrusel = document.getElementById("carrusel");
    const caption = document.getElementById("image-caption");

    function showImage(index) {
        carrusel.style.opacity = 0;
        setTimeout(() => {
            carrusel.src = images[index];
            caption.innerText = captions[index]; // Asegura el cambio del texto
            carrusel.style.opacity = 1;
        }, 500);
    }

    window.nextImage = function() {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    };

    window.prevImage = function() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    };

    setInterval(nextImage, 5000);
});

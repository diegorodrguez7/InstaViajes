//importacion del js con la funcionalidad para la vista detalles viaje

export let detallesviaje = `
<div id="detallesviaje"></div>

<div class="container-fluid text-center mt-5">
  <div class="row align-items-center mx-lg-5">
    <div class="col-10 mx-lg-5">
      <div id="carouselExampleInterval" class="carousel slide m-lg-5 p-3 shadow-lg rounded" data-bs-ride="carousel">
        <div class="carousel-inner" id="carruselitinerario"></div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        <div id="itinerarylist"></div>
      </div>
      
      <div id="detallesactividades"></div>
    </div>
  </div>
</div>

`
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Order Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f4f7ff] min-h-screen flex flex-col">
  <x-header></x-header>
  <x-productsearchbox></x-productsearchbox>
  <!-- Main content -->
  <main class="flex-grow px-6 sm:px-8 lg:px-12 mt-8 max-w-5xl mx-auto w-full">
   <section aria-label="My Order" class="bg-white rounded-lg shadow-md border border-gray-200 p-10">
    <h2 class="font-semibold text-lg mb-6">
     My Order
    </h2>
    <div class="border border-gray-300 rounded-md p-6 space-y-6">
     <div class="flex justify-between">
      <div class="w-1/2 max-w-xs">
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="transactionId">
        Transaction ID
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="transactionId" readonly="" type="text" value="27sb5weg29"/>
      </div>
      <div class="text-xs font-semibold text-gray-900 self-center">
       29 April 2025
      </div>
     </div>
     <div class="max-w-md">
      <label class="block text-xs font-semibold mb-1 text-gray-900" for="address">
       Address
      </label>
      <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="address" readonly="" type="text" value="Banjarnegara, Central Java, Indonesia"/>
     </div>
     <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl">
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="name">
        Name
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="name" readonly="" type="text" value="Erna Riyanti"/>
      </div>
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="phone">
        No Telp
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="phone" readonly="" type="text" value="+6281233088987"/>
      </div>
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="email">
        Email
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="email" readonly="" type="text" value="ernarianty10@gmail.com"/>
      </div>
     </div>
     <div>
      <p class="font-semibold text-sm mb-3">
       Product
      </p>
      <div class="flex items-center space-x-4 mb-4">
       <img alt="A small white handbag with floral pattern and gold chain handle" class="w-16 h-16 rounded-md object-contain bg-white border border-gray-200" height="64" src="https://storage.googleapis.com/a1aa/image/8447bbba-ed99-4abf-e603-1550c8b22990.jpg" width="64"/>
       <div class="flex-grow text-sm text-gray-900">
        <p class="text-xs mb-0.5">
         Aksesoris
        </p>
        <p class="font-semibold mb-0.5">
         Tas Warna Nusantara
        </p>
        <p class="mb-0.5">
         Qty: 1
        </p>
        <p class="mb-0.5">
         Subtotal:
        </p>
       </div>
       <div class="text-[#f68b1e] text-xs font-semibold cursor-pointer select-none">
        Beri Penilaian
       </div>
       <div class="font-semibold text-sm ml-6 select-none">
        $ 80
       </div>
      </div>
      <div class="flex items-center space-x-4">
       <img alt="Dark gray baseball cap with white NY logo on front" class="w-16 h-16 rounded-md object-contain bg-white border border-gray-200" height="64" src="https://storage.googleapis.com/a1aa/image/624b61f2-e59f-4c92-dab7-5c6c2d56792f.jpg" width="64"/>
       <div class="flex-grow text-sm text-gray-900">
        <p class="text-xs mb-0.5">
         Aksesoris
        </p>
        <p class="font-semibold mb-0.5">
         Topi Rupa Kita
        </p>
        <p class="mb-0.5">
         Qty: 1
        </p>
        <p class="mb-0.5">
         Subtotal:
        </p>
       </div>
       <div class="text-[#f68b1e] text-xs font-semibold cursor-pointer select-none">
        Beri Penilaian
       </div>
       <div class="font-semibold text-sm ml-6 select-none">
        $ 80
       </div>
      </div>
     </div>
     <div class="border-t border-gray-300 pt-4 max-w-xs ml-auto text-sm space-y-1">
      <p class="flex justify-between font-semibold">
       <span>
        Total Purchase:
       </span>
       <span>
        $ 160
       </span>
      </p>
      <p class="flex justify-between font-semibold">
       <span>
        Ongkir:
       </span>
       <span>
        $ 3
       </span>
      </p>
      <p class="flex justify-between font-bold">
       <span>
        Total Payment:
       </span>
       <span>
        $ 163
       </span>
      </p>
     </div>
     <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl">
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="noResi">
        No Resi
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="noResi" readonly="" type="text" value="JKAHSKYW7238HUEG"/>
      </div>
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="payment">
        Payment
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="payment" readonly="" type="text" value="BCA"/>
      </div>
      <div>
       <label class="block text-xs font-semibold mb-1 text-gray-900" for="courier">
        Courier
       </label>
       <input class="w-full bg-gray-100 rounded-md py-2 px-3 text-sm text-gray-700 cursor-default" id="courier" readonly="" type="text" value="JNE $3"/>
      </div>
     </div>
     <div class="flex justify-end max-w-3xl">
      <a href="\producttransaction" class="bg-gray-200 text-gray-900 font-semibold text-sm rounded-md py-2 px-6 mt-6" type="button">
       Back
      </a>
     </div>
    </div>
   </section>
  </main>
  <x-footer></x-footer>
  <script>
    // Elements
    const modal = document.getElementById("modal");
    const closeModalBtn = document.getElementById("closeModal");
    const openModal1 = document.getElementById("openModal1");
    const openModal2 = document.getElementById("openModal2");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("modalTitle");
    const modalStars = document.getElementById("modalStars");

    // Data for products
    const products = {
      openModal1: {
        image:
          "https://storage.googleapis.com/a1aa/image/a16aa5ec-ef1e-4f20-c9c9-b5bc8071148e.jpg",
        alt: "White handbag with colorful floral pattern, 160x160",
        title: "Tas Warna Nusantara",
        stars: 4,
      },
      openModal2: {
        image:
          "https://storage.googleapis.com/a1aa/image/5593cb0f-c023-4434-7569-7acbaf20fb82.jpg",
        alt: "Black baseball cap with white NY logo, 160x160",
        title: "Topi Rupa Kota",
        stars: 3,
      },
    };

    // Function to update stars
    function updateStars(starCount) {
      modalStars.innerHTML = "";
      for (let i = 1; i <= 5; i++) {
        const star = document.createElement("i");
        if (i <= starCount) {
          star.className = "fas fa-star";
        } else {
          star.className = "far fa-star";
        }
        modalStars.appendChild(star);
      }
    }

    // Open modal function
    function openModal(e) {
      const id = e.target.id;
      if (!products[id]) return;
      const product = products[id];
      modalImage.src = product.image;
      modalImage.alt = product.alt;
      modalTitle.textContent = product.title;
      updateStars(product.stars);
      modal.classList.remove("hidden");
    }

    // Close modal function
    function closeModal() {
      modal.classList.add("hidden");
    }

    // Event listeners
    openModal1.addEventListener("click", openModal);
    openModal2.addEventListener("click", openModal);
    closeModalBtn.addEventListener("click", closeModal);

    // Close modal on clicking outside modal content
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeModal();
      }
    });

    // Accessibility: open modal on Enter key on "Beri Penilaian"
    [openModal1, openModal2].forEach((el) => {
      el.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          openModal(e);
        }
      });
    });
  </script>
 </body>
</html>
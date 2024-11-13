
AOS.init({
  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 900, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: false, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});


const articles = [
  {
      image: "https://via.placeholder.com/300",
      title: "Article 1",
      date: "July 29, 2024",
      author: "Author Name 1",
      description: "Description for article 1."
  },
  {
      image: "https://via.placeholder.com/300",
      title: "Article 2",
      date: "July 29, 2024",
      author: "Author Name 2",
      description: "Description for article 2."
  },
  {
      image: "https://via.placeholder.com/300",
      title: "Article 3",
      date: "July 29, 2024",
      author: "Author Name 3",
      description: "Description for article 3."
  },
  // Add more article objects as needed
];

const cardsPerPage = 3;
let currentPage = 1;

function renderCards() {
  const cardContainer = document.getElementById("card-container");
  cardContainer.innerHTML = "";

  const startIndex = (currentPage - 1) * cardsPerPage;
  const endIndex = startIndex + cardsPerPage;
  const pageArticles = articles.slice(startIndex, endIndex);

  pageArticles.forEach(article => {
      const card = document.createElement("div");
      card.className = "card";
      card.innerHTML = `
          <img src="${article.image}" alt="${article.title}">
          <div class="card-content">
              <h5>${article.title}</h5>
              <p><small>${article.author} | ${article.date}</small></p>
              <p>${article.description}</p>
          </div>
      `;
      cardContainer.appendChild(card);
  });

  updatePagination();
}

function updatePagination() {
  const totalPages = Math.ceil(articles.length / cardsPerPage);
  document.getElementById("prev").disabled = currentPage === 1;
  document.getElementById("next").disabled = currentPage === totalPages;

  const pageNumbers = document.getElementById("page-numbers");
  pageNumbers.innerHTML = `Page ${currentPage} of ${totalPages}`;
}

function changePage(direction) {
  currentPage += direction;
  renderCards();
}

// Initial render
renderCards();



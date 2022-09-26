const searchInput = document.querySelector("[data-search]")
const userCardTemplate = document.querySelector("[data-user-template]")


fetch("https://jsonplaceholder.typicode.com/users")
  .then(res => res.json())
  .then(data => {
    users = data.map(user => {
      const card = userCardTemplate.content.cloneNode(true).children[0]
      const header = card.querySelector("[data-header]")
      const body = card.querySelector("[data-body]")
      header.textContent = product.name
      body.textContent = product.desc
      userCardContainer.append(card)
      return { name: product.name, description: product.desc , element: card }
    })
  })
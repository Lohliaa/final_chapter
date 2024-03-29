context('Reset Data Item', () => {
  // untuk mengisi formulir login dan password lalu mengirim formulir
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home'; // Ganti dengan URL yang sesuai
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url); 
  });

  it('Reset Data Item', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    // Setelah login berhasil, navigasi ke route 'item_list'
    cy.visit('http://localhost:8000/item_list'); 

    // Temukan tombol reset berdasarkan teks
    cy.get('button:contains("Reset")').click();

  });
});

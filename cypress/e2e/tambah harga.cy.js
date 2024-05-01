context('Tambah Daftar Harga', () => {
  // untuk mengisi formulir login dan password lalu mengirim formulir
  const loginUser = (email, password) => {
    cy.get('#email').type(email);
    cy.get('#password').type(password);
    cy.get('form').submit();
  };

  beforeEach(() => {
    const url = 'http://localhost:8000/home';
    cy.log(`Visiting URL: ${url}`);
    cy.visit(url);
  });

  it('Tambah Daftar Harga', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/harga');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Component Number Ori") + input').first().type('Z092-1153-15');
    cy.get('label:contains("Component Number MPL") + input').first().type(' -');
    cy.get('label:contains("Item") + input').first().type('-');
    cy.get('label:contains("Price Per Pcs") + input').first().type('0.1764');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});
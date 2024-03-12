context('Tambah Circuit Single', () => {
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

  it('Tambah Data', () => {
    loginUser("admin@gmail.com", "admin");
    cy.url().should('include', '/home');

    cy.visit('http://localhost:8000/konsep_commonize');
    cy.wait(1000);

    // Cari berdasarkan teks
    cy.contains('Tambah').click();

    // Temukan elemen formulir dan isi dengan data yang diberikan
    cy.get('label:contains("Material") + input').type('114A');
    cy.get('label:contains("Model") + input').type('NBA');
    cy.get('label:contains("Ukuran") + input').type('0.5');
    cy.get('label:contains("Warna") + input').type('W-B');
    cy.get('label:contains("CL") + input').type('134');
    cy.get('label:contains("Terminal B") + input').type('SOLDER0');
    cy.get('label:contains("Acc bag b1") + input').type('Z092-1153-15');
    cy.get('label:contains("Acc bag b2") + input').type('-');
    cy.get('label:contains("Tube B") + input').type('0097-3358-00');
    cy.get('label:contains("Terminal A") + input').type('0411-1697-20');
    cy.get('label:contains("Acc bag a1") + input').type('0100-6923-17');
    cy.get('label:contains("Acc bag a2") + input').type('-');
    cy.get('label:contains("Tube A") + input').type('0097-3358-00');

    // Klik tombol SIMPAN
    cy.get('button.btn-success').click();

  });
});

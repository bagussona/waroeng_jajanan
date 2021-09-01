
const invoke_react_element = (isClicked, invoice_data) => {
  'use strict';

  const r = React.createElement;

  const ProductInvoice = ({ invoice_data }) => {

    return (
      <>
        {
          invoices_data.map(invoice =>
            (
              <div id="invoice-detail-container" className="content_card_deck d-flex flex-column" style={{ height: 250 + 'px' }}>
                <div className="content d-flex flex-row">
                  <label id="product-name" style={{ marginBottom: 0, padding: '5px 15px', width: 235 + 'px', fontSize: 11 + 'px' }}>{invoice_data.name}</label>
                  <label id="amount" style={{ marginBottom: 0, padding: '5px 15px', width: 50 + 'px', textAlign: 'right', fontSize: 11 + 'px' }}> x{invoice_data.qty}</label>
                  <label id="subtotal" style={{ marginBottom: 0, padding: '5px 15px', width: 100 + 'px', textAlign: 'right', fontSize: 11 + 'px' }}>{new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(invoice_data.subtotal)}</label>
                </div>
              </div>
            )
          )
        }
      </>
    );
  }

  const domContainer = document.querySelector('#react-invoice');
  ReactDOM.render(e(ProductInvoice), domContainer);
}

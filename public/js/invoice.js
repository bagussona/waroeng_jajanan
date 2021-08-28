function createSeveralElements({ name, qty, subtotal }) {
  var body = document.body;

  const elements_obj = {
    container: 'div',
    wrapper: 'div',
    product_name: 'label',
    amount: 'label',
    subtotal: 'label'
  }

  const elements_style = {
    container: {
      attribute: {
        class: 'content_card_deck d-flex flex-column'
      },
      style: {
        height: '250px'
      }
    },
    wrapper: {
      attribute: {
        class: 'content d-flex flex-row'
      }
    },
    product_name: {
      attribute: {
        id: 'product_name',
      },
      style: {
        marginBottom: '0',
        padding: '5px 15px',
        width: '235px',
        fontSize: '11px'
      }
    },
    amount: {
      attribute: {
        id: 'amount',
      },
      style: {
        marginBottom: '0',
        padding: '5px 15px',
        width: '50px',
        textAlign: 'right',
        fontSize: '11px'
      }
    },
    subtotal: {
      attribute: {
        id: 'subtotal',
      },
      style: {
        marginBottom: '0',
        padding: '5px 15px',
        width: '100px',
        textAlign: 'right',
        fontSize: '11px'
      }
    }
  }


  const createElements = elementsObject => {
    var childEl = [];
    Object.keys(elementsObject).forEach(el => {
      var elNew = document.createElement(elementsObject[el]);
      elNew.setAttribute(Object.keys(elements_style[el].attribute), Object.values(elements_style[el].attribute));

      elements_style[el].style ? Object.keys(elements_style[el].style).forEach(style => elNew.style[style] = elements_style[el].style[style]) : null;
      childEl.push(elNew);
    });

    return childEl;
  }

  var [ container, wrapper, product_name, amount, sub_total ] = createElements(elements_obj);

  product_name.innerText = name;
  amount.innerText = qty;
  sub_total.innerText = subtotal;

  function insertToWrapper(label1, label2, label3) {

    wrapper.appendChild(label1);
    wrapper.appendChild(label2);
    wrapper.appendChild(label3);

    return wrapper;
  }

  function insertToContainer(wrapper) {
    var result_container = container.appendChild(wrapper);

    return result_container;
  }

  var container_result = insertToContainer(insertToWrapper(product_name, amount, sub_total));
  // insertToWrapper(product_name, amount, sub_total);
  return container_result;
}

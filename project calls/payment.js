const request = new PaymentRequest(
    buildSupportedPaymentMethodData(),
    buildShoppingCartDetails(),
  );

  function buildSupportedPaymentMethodData() {
    // Example supported payment methods:
    return [{ supportedMethods: "payment.html" }];
  }
  
  function buildShoppingCartDetails() {
    // Hardcoded for demo purposes:
    return {
      id: "order-123",
      displayItems: [
        {
          label: "Example item",
          amount: { currency: "USD", value: "1.00" },
        },
      ],
      total: {
        label: "Total",
        amount: { currency: "USD", value: "1.00" },
      },
    };
  }

  request.show().then((paymentResponse) => {
    // Here we would process the payment. For this demo, simulate immediate success:
    paymentResponse.complete("success").then(() => {
      // For demo purposes:
      introPanel.style.display = "none";
      successPanel.style.display = "block";
    });
  });

  // Dummy payment request to check whether payment can be made
new PaymentRequest(buildSupportedPaymentMethodData(), {
    total: { label: "Stub", amount: { currency: "USD", value: "0.01" } },
  })
    .canMakePayment()
    .then((result) => {
      if (result) {
        // Real payment request
        const request = new PaymentRequest(
          buildSupportedPaymentMethodData(),
          checkoutObject,
        );
        request.show().then((paymentResponse) => {
          // Here we would process the payment.
          paymentResponse.complete("success").then(() => {
            // Finish handling payment
          });
        });
      }
    });

    const checkoutButton = document.getElementById("checkout-button");
if (window.PaymentRequest) {
  let request = new PaymentRequest(
    buildSupportedPaymentMethodNames(),
    buildShoppingCartDetails(),
  );
  checkoutButton.addEventListener("click", () => {
    request
      .show()
      .then((paymentResponse) => {
        // Handle successful payment
      })
      .catch((error) => {
        // Handle cancelled or failed payment. For example, redirect to
        // the legacy web form checkout:
        window.location.href = "payment.html";
      });

    // Every click on the checkout button should use a new instance of
    // PaymentRequest object, because PaymentRequest.show() can be
    // called only once per instance.
    request = new PaymentRequest(
      buildSupportedPaymentMethodNames(),
      buildShoppingCartDetails(),
    );
  });
}

const Button = document.getElementById("checkout-button");
Button.innerText = "Loading…";
if (window.PaymentRequest) {
  const request = new PaymentRequest(
    buildSupportedPaymentMethodNames(),
    buildShoppingCartDetails(),
  );
  request
    .canMakePayment()
    .then((canMakeAFastPayment) => {
      Button.textContent = canMakeAFastPayment
        ? "Fast Checkout with W3C"
        : "Setup W3C Checkout";
    })
    .catch((error) => {
      // The user may have turned off the querying functionality in their
      // privacy settings. The website does not know whether they can make
      // a fast payment, so pick a generic title.
      checkoutButton.textContent = "Checkout with W3C";
    });
}

// The page has loaded. Should the page use PaymentRequest?
// If PaymentRequest fails, should the page fallback to manual
// web form checkout?
const supportedPaymentMethods = [
    /* supported methods */
  ];
  
  let shouldCallPaymentRequest = true;
  let fallbackToLegacyOnPaymentRequestFailure = false;
  new PaymentRequest(supportedPaymentMethods, {
    total: { label: "Stub", amount: { currency: "USD", value: "0.01" } },
  })
    .canMakePayment()
    .then((result) => {
      shouldCallPaymentRequest = result;
    })
    .catch((error) => {
      console.error(error);
  
      // The user may have turned off query ability in their privacy settings.
      // Let's use PaymentRequest by default and fallback to legacy
      // web form based checkout.
      shouldCallPaymentRequest = true;
      fallbackToLegacyOnPaymentRequestFailure = true;
    });
  
  // User has clicked on the checkout button. We know
  // what's in the cart, but we don't have a `Checkout` object.
  function onCheckoutButtonClicked(lineItems) {
    callServerToRetrieveCheckoutDetails(lineItems);
  }
  
  // The server has constructed the `Checkout` object. Now we know
  // all of the prices and shipping options.
  function onServerCheckoutDetailsRetrieved(checkoutObject) {
    if (shouldCallPaymentRequest) {
      const request = new PaymentRequest(supportedPaymentMethods, checkoutObject);
      request
        .show()
        .then((paymentResponse) => {
          // Post the results to the server and call `paymeResponse.complete()`.
        })
        .catch((error) => {
          console.error(error);
          if (fallbackToLegacyOnPaymentRequestFailure) {
            window.location.href = "payment.html";
          } else {
            showCheckoutErrorToUser();
          }
        });
    } else {
      window.location.href = "payment.html";
    }
  }

  checkoutButton.addEventListener("click", () => {
    const request = new PaymentRequest(
      buildSupportedPaymentMethodData(),
      buildShoppingCartDetails(),
    );
    request
      .show()
      .then((paymentResponse) => {
        // Here we would process the payment. For this demo, simulate immediate success:
        paymentResponse.complete("success").then(() => {
          // For demo purposes:
          introPanel.style.display = "none";
          successPanel.style.display = "block";
        });
      })
      .catch((error) => {
        if (error.code === DOMException.NOT_SUPPORTED_ERR) {
          window.location.href = "https://bobpay.xyz/#download";
        } else {
          // Other kinds of errors; cancelled or failed payment. For demo purposes:
          introPanel.style.display = "none";
          legacyPanel.style.display = "block";
        }
      });
  });

  request
  .show()
  .then((paymentResponse) => {
    // Process payment here.
    // Close the UI:
    paymentResponse.complete('success').then(() => {
      // Request additional shipping address details.
      const additionalDetailsContainer = document.getElementById('additional-details-container');
      additionalDetailsContainer.style.display = 'block';
      window.scrollTo(additionalDetailsContainer.getBoundingClientRect().x, 0);
  })
  .catch((error) => {
    // Handle error.
  });
});
  const paymentRequest = new PaymentRequest(
    [{ supportedMethods: "payment.html" }],
    details,
  );
  
  // Send `CanMakePayment` event to the payment handler.
  paymentRequest
    .canMakePayment()
    .then((res) => {
      if (res) {
        // The payment handler has pre-authorized a transaction
        // with some static amount, e.g., USD $1.00.
      } else {
        // Pre-authorization failed or payment handler not installed.
      }
    })
    .catch((err) => {
      // Unexpected error occurred.
    });

    self.addEventListener("canmakepayment", (evt) => {
        // Pre-authorize here.
        const preAuthSuccess = true;
        evt.respondWith(preAuthSuccess);
    })
      
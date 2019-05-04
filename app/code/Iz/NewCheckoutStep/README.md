## how to create new checkout step
- Create the view part of the checkout step component.

1. Define a component by extend ui component
Iz/NewCheckoutStep/view/frontend/web/js/view/my-step-view.js
2. Create template file what is using in ui component
Iz/NewCheckoutStep/view/frontend/web/template/mystep.phtml

- Add your step to the Checkout page layout.
Iz/NewCheckoutStep/view/frontend/layout/checkout_index_index.xml
- Create mixins for payment and shipping steps (optional).

## Custom Payment Method
1. Create js component define template
2. Wanna use configuration from backend so we need to implement **ConfigProviderInterface** . 
By adding that instance to Magento\Checkout\Model\CompositeConfigProvider we can refer it on js by window.checkoutConfig variable.
3. Add to render list
4. Define in layout xml

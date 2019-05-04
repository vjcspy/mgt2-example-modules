- Create custom file xml configuration:

`Benefit:`
- Separate configuration between many environments.
- configuration is cached by default magento


`How this work:`
- Create xml file
- Use tool to create xsd definition file and update xml file to use xsd file
- To make the XML file accessible via built in Magento tools (and make it cacheable as well) it’s necessary to initialize it in the Dependency Injection configuration (/etc/di.xml):

`-- Create Reader: VirtualType created that extends **\Magento\Framework\Config\Reader\
Filesystem**, specifies the converter, schemaLocator, and fileName.`

`-- Define file config data: specifies the reader class and cache name`

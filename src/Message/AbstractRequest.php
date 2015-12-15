<?php
/**
 * Copyright 2015 Zerve, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Omnipay\ElementExpress\Message;

use Omnipay\Common\Helper;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Omnipay\ElementExpress\Model\ApplicationTrait;
use Omnipay\ElementExpress\Model\CredentialsTrait;
use Omnipay\ElementExpress\Model\AbstractModel;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * ElementExpress Abstract Request
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use ApplicationTrait;
    use CredentialsTrait;

    abstract protected function getEndpoint();
    abstract protected function getXmlNamespace();

    /**
     * Retrieve an array of models used by this request. Models are found based
     * on the presence of a getter following the format getNameModel where "Name"
     * is the name of the model.
     *
     * @return array
     * @throws \UnexpectedValueException if any found model does not inherit from AbstractModel
     */
    public function getModels()
    {
        $models  = array();
        $methods = preg_grep('/^get\w+Model$/', get_class_methods($this));
        foreach ($methods as $method) {
            $model = $this->$method();
            if (!$model instanceof AbstractModel) {
                throw new \UnexpectedValueException('Expected model to be instance of AbstractModel');
            }
            $models[] = $this->$method();
        }
        return $models;
    }

    /**
     * Create a DOM document using the provide $tagName and correct namespace as
     * the document element.
     *
     * @param string $tagName The name of the tag for the documentElement
     * @return \DOMDocument
     */
    protected function domDocumentFactory($tagName)
    {
        $namespace = $this->getXmlNamespace();
        $document  = new \DOMDocument('1.0');
        $document->appendChild(new \DOMElement($tagName, null, $namespace));
        foreach ($this->getModels() as $model) {
            $model->appendToDom($document->documentElement);
        }
        return $document;
    }

    /**
     * Send data
     *
     * @param \DOMDocument $data Data
     */
    public function sendData($data)
    {
        // Prune empty nodes.
        $xpath = new \DOMXPath($data);
        foreach ($xpath->query('//*[not(node())]') as $node) {
            $node->parentNode->removeChild($node);
        }

        $headers = ['Content-Type' => 'text/xml; charset=utf-8'];

        $httpResponse = $this->httpClient
            ->post($this->getEndpoint(), $headers, $data->saveXML())
            ->send();

        return $this->response = new Response(
            $this,
            $httpResponse->getBody()
        );
    }
}

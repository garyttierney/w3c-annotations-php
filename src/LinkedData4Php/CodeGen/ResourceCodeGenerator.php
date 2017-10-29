<?php

namespace LinkedData4Php\CodeGen;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Metadata\ResourceMetadata;
use LinkedData4Php\Model\Resource;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;

class ResourceCodeGenerator
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    public function __construct(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function generateCode(ResourceMetadata $metadata): ResourceCode
    {
        $resourceInterfaceName = $metadata->getClassName();
        $resourceInterface = new ReflectionClass($resourceInterfaceName);

        $directSuperTypes = [$resourceInterfaceName];

        $resourceClassBody = str_replace(
            ['<namespace>', '<className>'],
            [$resourceInterface->getNamespaceName(), $resourceInterface->getShortName().'Impl'],
            self::classSkeleton()
        );

        $implementsList = implode(
            ', ',
            array_map(
                function (string $type) {
                    return "\\$type";
                },
                $directSuperTypes
            )
        );

        $resourceClassBody = str_replace('<implementsList>', $implementsList, $resourceClassBody);
        $methodBodies = [];

        foreach ($resourceInterface->getMethods() as $method) {
            $iri = $this->annotationReader->getMethodAnnotation($method, Iri::class);
            $prefix = substr($method->getName(), 0, 3);

            $declaringClass = $method->getDeclaringClass();
            $declaringClassName = $declaringClass->getName();

            if (Resource::class === $declaringClassName) {
                continue;
            }

            if ('add' === $prefix || 'set' === $prefix) {
                if (1 !== $method->getNumberOfParameters()) {
                    throw new \InvalidArgumentException('Expected 1 parameter');
                }

                $parameters = $method->getParameters();
                $parameter = $parameters[0];

                $arg = $parameter->getName();
                $argType = $parameter->getType()->getName();

                if (!$parameter->getType()->isBuiltin()) {
                    $argType = "\\$argType";
                }

                if ($parameter->getType()->allowsNull()) {
                    $argType = "?$argType";
                }

                if ($parameter->isVariadic()) {
                    $argType .= '...';
                }

                $template = 'add' === $prefix ? self::addMethodSkeleton() : self::setMethodSkeleton();
                $template = str_replace(['<arg>', '<argType>'], [$arg, $argType], $template);
            } elseif ('get' === $prefix) {
                $template = self::getMethodSkeleton();
                $returnType = $method->getReturnType()->getName();

                if (!$method->getReturnType()->isBuiltin()) {
                    $returnType = "\\$returnType";
                }

                if ($method->getReturnType()->allowsNull()) {
                    $returnType = "?$returnType";
                }

                $template = str_replace('<returnType>', $returnType, $template);
            } else {
                throw new \InvalidArgumentException('Invalid method prefix found');
            }

            $template = str_replace(
                ['<name>', '<propertyName>'],
                [$method->getName(), '"'.addslashes($iri->value).'"'],
                $template
            );

            $methodBodies[] = $template;
        }

        $resourceClassBody = str_replace('<methods>', implode("\n\n", $methodBodies), $resourceClassBody);

        return new ResourceCode($resourceInterface->getName().'Impl', $resourceClassBody);
    }

    private static function addMethodSkeleton()
    {
        return <<<PHP
public function <name>(<argType> \$<arg>) : void
{
    \$this->properties[<propertyName>][] = \$<arg>;
}
PHP;
    }

    private static function setMethodSkeleton()
    {
        return <<<EOF
public function <name>(<argType> \$<arg>) : void 
{
    \$this->properties[<propertyName>] = \$<arg>;
}
EOF;
    }

    private static function getMethodSkeleton()
    {
        return <<<EOF
public function <name>() : <returnType>
{
    return \$this->properties[<propertyName>];
}
EOF;
    }

    private static function classSkeleton()
    {
        return <<<EOF
namespace <namespace>;
        
final class <className> extends \LinkedData4Php\Model\SimpleResource implements <implementsList> {

<methods>

}
EOF;
    }
}

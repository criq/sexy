# Sexy Library - AI Agent Documentation

> **Agent Protocol: Keep This Document Updated**
> All agents are required to update this document with any new, relevant information discovered during their work. This includes, but is not limited to, changes in architecture, new dependencies, updated build processes, or newly established coding conventions. A well-maintained document ensures efficiency and prevents repeated discovery work.

This document provides comprehensive technical documentation for the `criq/sexy` library used in the v2 application. Sexy is a custom PHP query builder that provides a fluent, type-safe interface for building SQL queries with extensive support for MySQL functions and operations.

---

## 1. Library Overview

### 1.1. Basic Information
- **Name:** `criq/sexy`
- **Type:** Custom PHP query builder library
- **Description:** "sexy sql expressions"
- **Location:** `vendor/criq/sexy/`
- **Namespace:** `Sexy\`
- **Dependencies:** `criq/katu` (^4)
- **PHP Version:** >=7

### 1.2. Core Architecture
- **Query Builder:** Fluent interface for building SQL queries
- **Expression System:** All SQL components are expressions
- **Parameter Binding:** Automatic parameter binding for security
- **MySQL Focus:** Optimized for MySQL with extensive function support
- **Type Safety:** Strong typing with column and table objects

---

## 2. Core Classes

### 2.1. Main Entry Point (`Sexy\Sexy`)
**Location:** `src/Sexy.php`

The main static class that provides access to all query building functionality:

```php
// Key methods:
public static function __callStatic($name, $args) // Dynamic class instantiation
public static function select() // Create SELECT query
public static function eq() // Create equality comparison
public static function coll() // Create expression collection
public static function a() // Create alias
public static function aka() // Create AS alias
public static function kw() // Create keyword
public static function placeholder() // Create parameter placeholder
```

**Key Features:**
- Dynamic method calls for all expression types
- Fluent interface for query building
- Automatic class instantiation based on method names

### 2.2. Expression System (`Sexy\Expression`)
**Location:** `src/Expression.php`

Abstract base class for all SQL expressions:

```php
// Key methods:
abstract public function getSql(&$context = []) // Generate SQL
public function getSqlWithValues() // Generate SQL with values inline
public function __toString() // String representation
```

**Key Features:**
- Abstract base for all SQL components
- Context-aware SQL generation
- Parameter binding support
- String conversion for debugging

### 2.3. Command Base (`Sexy\Command`)
**Location:** `src/Command.php`

Abstract base class for SQL commands (SELECT, INSERT, etc.):

```php
// Key methods:
public function select(Expression $expression): Command
public function from(Expression $expression): Command
public function join(Expression $expression): Command
public function where(Expression $expression): Command
public function groupBy(Expression $expression): Command
public function having(Expression $expression): Command
public function orderBy(Expression $expression): Command
public function setLimit(?Limit $limit): Command
public function setPage(?Page $page): Command
```

**Key Features:**
- Fluent query building interface
- Expression grouping and management
- Table and column introspection
- Parameter collection
- Join helper methods

---

## 3. Query Types

### 3.1. SELECT Queries (`Sexy\Select`)
**Location:** `src/Select.php`

Main class for building SELECT queries:

```php
// Key methods:
public function setGetFoundRows(bool $value = true): Select
public function setGetDistinctRows(bool $value = true): Select
public function setGetTotalOnly(bool $value = true): Select
public function setIntoOutfile(File $file, ...): Select
```

**Key Features:**
- SQL_CALC_FOUND_ROWS support
- DISTINCT queries
- File export capabilities
- Pagination support
- Complex JOIN handling

### 3.2. INSERT Queries (`Sexy\Insert`)
**Location:** `src/Insert.php`

Class for building INSERT queries:

```php
// Key methods:
public function into(Expression $expression): Command
public function columns(Expression $expression): Command
```

**Key Features:**
- Table and column specification
- SELECT-based inserts
- Expression-based values

---

## 4. Comparison Operators

### 4.1. Base Comparison (`Sexy\Cmp`)
**Location:** `src/Cmp.php`

Abstract base class for all comparison operations:

```php
// Key properties:
public $name; // Left side expression
public $value; // Right side expression/value
```

**Key Features:**
- Automatic parameter handling
- Array value support
- Expression chaining
- Type-safe comparisons

### 4.2. Common Comparisons

#### Equality (`Sexy\CmpEq`)
```php
SX::eq($column, $value) // column = value
```

#### Inequality (`Sexy\CmpNotEq`)
```php
SX::notEq($column, $value) // column != value
```

#### IN Operations (`Sexy\CmpIn`)
```php
SX::in($column, [$value1, $value2]) // column IN (value1, value2)
```

#### LIKE Operations (`Sexy\CmpLike`)
```php
SX::like($column, $pattern) // column LIKE pattern
SX::likeAllWords($column, $text) // Multi-word LIKE
SX::likeAnyWords($column, $text) // Any-word LIKE
```

#### NULL Checks (`Sexy\CmpIsNull`, `Sexy\CmpIsNotNull`)
```php
SX::isNull($column) // column IS NULL
SX::isNotNull($column) // column IS NOT NULL
```

#### Range Operations (`Sexy\CmpBetween`)
```php
SX::between($column, $min, $max) // column BETWEEN min AND max
```

#### Numeric Comparisons
- `CmpGreaterThan` - `>`
- `CmpGreaterThanOrEqual` - `>=`
- `CmpLessThan` - `<`
- `CmpLessThanOrEqual` - `<=`

---

## 5. Logical Operators

### 5.1. AND Operations (`Sexy\LgcAnd`)
**Location:** `src/LgcAnd.php`

```php
SX::lgcAnd([$expr1, $expr2, $expr3]) // (expr1) AND (expr2) AND (expr3)
```

### 5.2. OR Operations (`Sexy\LgcOr`)
**Location:** `src/LgcOr.php`

```php
SX::lgcOr([$expr1, $expr2, $expr3]) // (expr1) OR (expr2) OR (expr3)
```

### 5.3. NOT Operations (`Sexy\LgcNot`)
**Location:** `src/LgcNot.php`

```php
SX::lgcNot($expression) // NOT (expression)
```

---

## 6. SQL Functions

### 6.1. Base Function (`Sexy\Fnc`)
**Location:** `src/Fnc.php`

Abstract base class for all SQL functions:

```php
// Key properties:
public $function; // Function name (Keyword)
public $arguments; // Function arguments array
public $alias; // Optional alias
```

### 6.2. Aggregate Functions

#### Count (`Sexy\FncCount`)
```php
SX::count($column) // COUNT(column)
SX::countDistinct($column) // COUNT(DISTINCT column)
```

#### Sum (`Sexy\FncSum`)
```php
SX::sum($column) // SUM(column)
```

#### Average (`Sexy\FncAvg`)
```php
SX::avg($column) // AVG(column)
```

#### Min/Max (`Sexy\FncMin`, `Sexy\FncMax`)
```php
SX::min($column) // MIN(column)
SX::max($column) // MAX(column)
```

#### Group Concat (`Sexy\FncGroupConcat`)
```php
SX::groupConcat($columns, $orderBy, $separator, $distinct)
// GROUP_CONCAT(DISTINCT columns ORDER BY orderBy SEPARATOR separator)
```

### 6.3. String Functions

#### Concatenation (`Sexy\FncConcat`)
```php
SX::concat($str1, $str2, $str3) // CONCAT(str1, str2, str3)
SX::concatWs($separator, $str1, $str2) // CONCAT_WS(separator, str1, str2)
```

#### String Manipulation
- `FncUpper` - `UPPER()`
- `FncLower` - `LOWER()`
- `FncTrim` - `TRIM()`
- `FncSubstr` - `SUBSTR()`
- `FncLength` - `LENGTH()`
- `FncReplace` - `REPLACE()`

### 6.4. Date/Time Functions

#### Current Time
- `FncNow` - `NOW()`
- `FncCurrentDate` - `CURDATE()`

#### Date Extraction
- `FncYear` - `YEAR()`
- `FncMonth` - `MONTH()`
- `FncDay` - `DAY()`
- `FncHour` - `HOUR()`
- `FncMinute` - `MINUTE()`
- `FncSecond` - `SECOND()`

#### Date Arithmetic
- `FncDateAdd` - `DATE_ADD()`
- `FncDateSub` - `DATE_SUB()`
- `FncDateDiff` - `DATEDIFF()`
- `FncTimeDiff` - `TIMEDIFF()`

#### Timestamps
- `FncUnixTimestamp` - `UNIX_TIMESTAMP()`
- `FncTimestamp` - `TIMESTAMP()`
- `FncStrToDate` - `STR_TO_DATE()`
- `FncStrToDatetime` - `STR_TO_DATETIME()`

### 6.5. Mathematical Functions

#### Basic Math
- `FncAbs` - `ABS()`
- `FncCeil` - `CEIL()`
- `FncFloor` - `FLOOR()`
- `FncRound` - `ROUND()`
- `FncPow` - `POW()`

#### Trigonometric
- `FncSin` - `SIN()`
- `FncCos` - `COS()`
- `FncAcos` - `ACOS()`

#### Statistical
- `FncGreatest` - `GREATEST()`
- `FncLeast` - `LEAST()`

### 6.6. Conditional Functions

#### IF Operations
- `FncIf` - `IF(condition, true_value, false_value)`
- `FncIfNull` - `IFNULL(value, default)`
- `FncNullIf` - `NULLIF(value1, value2)`
- `FncCoalesce` - `COALESCE(value1, value2, ...)`

#### Case Statements
- `CmpCase` - `CASE WHEN ... THEN ... END`
- `CmpWhen` - `WHEN condition THEN value`

### 6.7. JSON Functions

#### JSON Operations
- `FncJsonExtract` - `JSON_EXTRACT()`
- `FncJsonObject` - `JSON_OBJECT()`
- `FncJsonContains` - `JSON_CONTAINS()`
- `FncJsonUnquote` - `JSON_UNQUOTE()`

---

## 7. Joins and Relationships

### 7.1. Join Operations (`Sexy\Join`)
**Location:** `src/Join.php`

```php
// Key properties:
public $join; // Table or subquery to join
public $conditions; // Join conditions
public $direction; // JOIN type (INNER, LEFT, RIGHT, etc.)
public $alias; // Table alias
```

### 7.2. Join Types
- `Join` - `INNER JOIN`
- `LeftJoin` - `LEFT JOIN`

### 7.3. Join Helpers
```php
// Column-based joins
$command->joinColumns($ownColumn, $foreignColumn)
$command->leftJoinColumns($ownColumn, $foreignColumn)
```

---

## 8. Parameters and Values

### 8.1. Parameters (`Sexy\Param`)
**Location:** `src/Param.php`

```php
// Key methods:
public function __construct($name, $value) // Named parameter
public function __construct($value) // Anonymous parameter
```

**Key Features:**
- Automatic parameter naming
- SQL injection prevention
- Context-aware value rendering
- Subquery support

### 8.2. Parameter Collections (`Sexy\ParamCollection`)
**Location:** `src/ParamCollection.php`

```php
// Key methods:
public function add($param) // Add parameter
public function getSql(&$context = []) // Generate SQL
```

### 8.3. Parameter Placeholders (`Sexy\ParamPlaceholder`)
**Location:** `src/ParamPlaceholder.php`

For creating named parameter placeholders.

---

## 9. Pagination and Limits

### 9.1. Limits (`Sexy\Limit`)
**Location:** `src/Limit.php`

```php
// Key methods:
public function __construct(?int $limit = null, ?int $offset = null)
public function setLimit(?int $limit): Limit
public function setOffset(?int $offset): Limit
```

### 9.2. Pagination (`Sexy\Page`)
**Location:** `src/Page.php`

```php
// Key methods:
public function __construct($page = 1, $perPage = 50)
public function getOffset(): int
public function getLimit(): int
public function getSql(&$context = [])
```

**Key Features:**
- Page-based pagination
- Offset calculation
- Parameter binding support
- Default page size management

---

## 10. Ordering and Grouping

### 10.1. Order By (`Sexy\OrderBy`)
**Location:** `src/OrderBy.php`

```php
// Key methods:
public function __construct(Expression $orderBy, Keyword $direction = null)
```

### 10.2. Group By (`Sexy\GroupBy`)
**Location:** `src/GroupBy.php`

For grouping query results.

---

## 11. Collections and Utilities

### 11.1. Expression Collections (`Sexy\ExpressionCollection`)
**Location:** `src/ExpressionCollection.php`

```php
// Key methods:
public function addExpression(Expression $expression): ExpressionCollection
public function setDelimiter(string $value): ExpressionCollection
public function getSql(&$context = [])
```

**Key Features:**
- Array-like interface
- Customizable delimiters
- Iterator support
- Countable interface

### 11.2. Aliases (`Sexy\Alias`, `Sexy\AsAlias`)
**Location:** `src/Alias.php`, `src/AsAlias.php`

```php
SX::a($name) // Create alias
SX::aka($expression, $alias) // Create AS alias
```

### 11.3. Keywords (`Sexy\Keyword`)
**Location:** `src/Keyword.php`

For SQL keywords like `ASC`, `DESC`, `DISTINCT`, etc.

---

## 12. Usage Patterns in v2 Application

### 12.1. Basic Query Pattern
```php
use Sexy\Sexy as SX;

$sql = SX::select()
    ->from(Model::getTable())
    ->where(SX::eq(Model::getColumn("active"), 1))
    ->orderBy(SX::orderBy(Model::getColumn("name")));

$results = Model::getBySQL($sql);
```

### 12.2. Complex Joins
```php
$sql = SX::select()
    ->from(Recipe::getTable())
    ->join(SX::join(RecipeVersion::getTable(), SX::lgcAnd([
        SX::eq(Recipe::getIdColumn(), RecipeVersion::getColumn("recipeId")),
    ])))
    ->where(SX::eq(Recipe::getColumn("active"), 1));
```

### 12.3. Search Queries
```php
$match = SX::lgcOr([
    SX::cmpLikeAllWords(RecipeVersion::getColumn("nameSearchable"), SX::param($searchTerm)),
    SX::cmpLikeAllWords(RecipeVersion::getColumn("searchable"), SX::param($searchTerm)),
]);
```

### 12.4. Aggregation Queries
```php
$sql = SX::select()
    ->select(SX::count(SomeModel::getIdColumn()))
    ->from(SomeModel::getTable())
    ->groupBy(SomeModel::getColumn("categoryId"));
```

### 12.5. Conditional Functions
```php
$sql = SX::select()
    ->select(SX::aka(SX::fncIfNull([
        DiaryDayMeal::getColumn("timeConsumed"),
        DiaryDayMeal::getColumn("timeCreated"),
    ]), SX::a("timeConsumed")));
```

---

## 13. Best Practices

### 13.1. Query Building
- Always use parameter binding for user input
- Use column objects instead of string names
- Chain methods for readability
- Use appropriate comparison operators

### 13.2. Performance
- Use `setGetFoundRows(false)` when not needing total count
- Use `setGetDistinctRows(true)` for unique results
- Use appropriate indexes for WHERE clauses
- Limit result sets with pagination

### 13.3. Security
- Never concatenate user input directly into SQL
- Use parameter binding for all dynamic values
- Validate input before query building
- Use appropriate comparison operators

### 13.4. Maintainability
- Use descriptive aliases
- Group related conditions logically
- Use helper methods for common patterns
- Document complex queries

---

## 14. Common Patterns

### 14.1. Model Integration
```php
class ExampleModel extends \App\Models\Model
{
    public static function getActiveSQL(): \Sexy\Select
    {
        return SX::select()
            ->from(static::getTable())
            ->where(SX::eq(static::getColumn("active"), 1));
    }
}
```

### 14.2. Filter Collections
```php
public function getSQL(): Select
{
    $sql = SX::select()
        ->from(Model::getTable());

    foreach ($this->filters as $filter) {
        $sql->addExpressions($filter->getSQLExpressions());
    }

    return $sql;
}
```

### 14.3. API Controllers
```php
public function getBaseSQL(ServerRequestInterface $request): \Sexy\Select
{
    $auth = User::getFromRequest($request);

    return SX::select()
        ->from(SomeModel::getTable())
        ->where(SX::eq(SomeModel::getColumn("userId"), $auth->getId()));
}
```

---

## 15. Troubleshooting

### 15.1. Common Issues
- **Parameter Binding:** Ensure all dynamic values use `SX::param()`
- **Column References:** Use `Model::getColumn()` instead of strings
- **Join Conditions:** Use proper join syntax with conditions
- **SQL Generation:** Use `getSqlWithValues()` for debugging

### 15.2. Debugging
- Use `echo $sql->getSqlWithValues()` to see generated SQL
- Check parameter binding with `$sql->getParams()`
- Verify table and column references
- Test queries in database directly

---

## 16. Integration with KATU

### 16.1. Model Integration
- Models use `Sexy\Sexy as SX` for query building
- Column objects from `Model::getColumn()`
- Table objects from `Model::getTable()`
- Query execution through `Model::getBySQL()`

### 16.2. Database Connections
- Uses KATU's PDO connection system
- Automatic parameter binding
- Transaction support
- Connection pooling

---

This documentation provides a comprehensive overview of the Sexy library. For specific implementation details, refer to the source code in `src/` and usage examples in the v2 application.

<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:template match="/">
    <adjunctcontainer>
      <adjunct id="smid:{$smid}" version="1.0">
        <xsl:choose>
          <xsl:when test="//Result">
            <item rel="media:Thumbnail" resource="{//Result}" />
          </xsl:when>
          <xsl:otherwise>
            <item rel="media:Thumbnail" resource="http://not_real" />
          </xsl:otherwise>
        </xsl:choose>
      </adjunct>
    </adjunctcontainer>
  </xsl:template>
</xsl:stylesheet>
